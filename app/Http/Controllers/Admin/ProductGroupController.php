<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Http\Request;

class ProductGroupController extends Controller
{
	/**
     * @param Request $request
     * @param Product $product
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGroupProducts(Request $request, Product $product)
    {
    	$currentProductId = $request->input('current_product_id');

        if ($groupId = $request->input('group_id')) {
            $products = $product->whereGroupId($groupId)->get();

            return view('renders.product_group', compact('products', 'currentProductId'));
        }

        return response()->json(['status' => 'error', 'messages' => [trans('product.group_is_required')]]);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param ProductGroup $productGroup
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProductToGroup(Request $request, Product $product, ProductGroup $productGroup)
    {
    	$groupId = $request->input('group_id');

    	$product = $product->findOrFail($request->input('product_id'));
        $productGroupId = $product->group_id;

        // Count number of products from the group
    	$countGroupProducts = $product->whereGroupId($product->group_id)->count();

        // Update product group
    	$product->update(['group_id' => $groupId]);

        // Delete product group if there is only one product
        if ($countGroupProducts == 1) {
            $productGroup->findOrFail($productGroupId)->delete();
        }

    	return response()->json(['status' => strtolower(trans('common.success'))]);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param ProductGroup $productGroup
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeProductFromGroup(Request $request, Product $product, ProductGroup $productGroup)
    {
    	$product = $product->findOrFail($request->input('product_id'));

        // Count number of products from the group
		$countGroupProducts = $product->whereGroupId($product->group_id)->count();

        // Delete product group if there is only itself in it
    	if ($countGroupProducts == 1) {
    		$productGroup->findOrFail($product->group_id)->delete();
    	}

        // Create group entry
    	$productGroup = $productGroup->create();

        // Update product group
    	$product->update(['group_id' => $productGroup->id]);

    	return response()->json(['status' => strtolower(trans('common.success'))]);
    }

    /**
     * @param Request $request
     * @param Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function getUngroupedProducts(Request $request, Product $product)
    {
        $ungroupedProducts = [];

        // Get all groups that have only one product in them
		$groups = $product->active()->selectRaw('count(group_id) as `group`, group_id')->groupBy('group_id')->having('group', '=', 1)->pluck('group_id')->toArray();

        // Get all active products
        $activeProducts = $product->active();

        // Exclude current product from list
		if ($excluded_product_id = $request->input('excluded_product_id')) {
            $ungroupedProducts = $activeProducts->where('id', '!=', $excluded_product_id);
		}

        // Get all products that are not in a group
		$ungroupedProducts = $activeProducts->whereIn('group_id', $groups)->get();

		return view('renders.ungrouped_products', compact('ungroupedProducts'));
    }


}
