<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\User;
use Illuminate\Http\Request;

class ClientAddressController extends Controller
{

    /**
     * @param Request $request
     * @param User $user
     *
     * @return mixed
     */
    public function getClientAddresses(Request $request, User $user)
    {
        if ($clientId = $request->input('client_id')) {
            $addresses = $user->findOrFail($clientId)->addresses;

            return view('renders.client_addresses', compact('addresses'));
        }

        return response()->json(['status' => 'error', 'messages' => [trans('address.client_is_required')]]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @param Address $address
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addClientAddress(Request $request, User $user, Address $address)
    {
        if ($clientId = $request->input('address')['client_id']) {
            $user = $user->findOrFail($clientId);

            $user->addresses()->create($request->input('address'));

            return response()->json(['status' => 'success']);

        }

        return response()->json(['status' => 'error', 'messages' => [trans('address.client_is_required')]]);
    }

    /**
     * @param Request $request
     * @param Address $address
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteClientAddress(Request $request, Address $address)
    {
        if ($id = $request->input('id')) {
            $address->findOrFail($id)->delete();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'messages' => [trans('address.address_id_is_required')]]);
    }
}
