<?php

Route::get('/', function () {
    return view('welcome');
});

// Admin Interface
Route::group(['middleware' => 'admin',
			  'prefix'     => 'admin',
              'namespace'  => 'Admin'
], function () {

	CRUD::resource('categories', 'CategoryCrudController');
	CRUD::resource('currencies', 'CurrencyCrudController');
	CRUD::resource('carriers', 'CarrierCrudController');
	CRUD::resource('attributes', 'AttributeCrudController');
	CRUD::resource('attributes-sets', 'AttributeSetCrudController');
	CRUD::resource('products', 'ProductCrudController');
	CRUD::resource('taxes', 'TaxCrudController');
	CRUD::resource('orders', 'OrderCrudController');
	CRUD::resource('order-statuses', 'OrderStatusCrudController');
	CRUD::resource('users', 'UserCrudController');

	// Clone Products
	Route::post('products/clone', ['as' => 'clone.product', 'uses' => 'ProductCrudController@cloneProduct']);
});


// Ajax
Route::group(['middleware' => 'admin',
			  'prefix' => 'ajax',
			  'namespace' => 'Admin'
], function() {
	// Get attributes by set id
	Route::post('attribute-sets/list-attributes', ['as' => 'getAttrBySetId', 'uses' => 'AttributeSetCrudController@ajaxGetAttributesBySetId']);

	// Product images upload routes
	Route::post('product/image/upload', ['as' => 'uploadProductImages', 'uses' => 'ProductCrudController@ajaxUploadProductImages']);
	Route::post('product/image/reorder', ['as' => 'reorderProductImages', 'uses' => 'ProductCrudController@ajaxReorderProductImages']);
	Route::post('product/image/delete', ['as' => 'deleteProductImage', 'uses' => 'ProductCrudController@ajaxDeleteProductImage']);

	// Get group products by group id
	Route::post('product-group/list/products', ['as' => 'getGroupProducts', 'uses' => 'ProductGroupController@getGroupProducts']);
	Route::post('product-group/list/ungrouped-products', ['as' => 'getUngroupedProducts', 'uses' => 'ProductGroupController@getUngroupedProducts']);
	Route::post('product-group/add/product', ['as' => 'addProductToGroup', 'uses' => 'ProductGroupController@addProductToGroup']);
	Route::post('product-group/remove/product', ['as' => 'removeProductFromGroup', 'uses' => 'ProductGroupController@removeProductFromGroup']);
});
