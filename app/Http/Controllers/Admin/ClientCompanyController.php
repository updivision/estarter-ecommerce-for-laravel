<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\User;
use Illuminate\Http\Request;

class ClientCompanyController extends Controller
{

    /**
     * @param Request $request
     * @param User $user
     *
     * @return mixed
     */
    public function getClientCompanies(Request $request, User $user)
    {
        if ($clientId = $request->input('client_id')) {
            $companies = $user->findOrFail($clientId)->companies;

            return view('renders.client_companies', compact('companies'));
        }

        return response()->json(['status' => 'error', 'messages' => [trans('company.client_is_required')]]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @param Company $company
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addClientCompany(Request $request, User $user, Company $company)
    {
        if ($clientId = $request->input('company')['client_id']) {
            $user = $user->findOrFail($clientId);

            $user->companies()->create($request->input('company'));

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'messages' => [trans('company.client_is_required')]]);
    }

    /**
     * @param Request $request
     * @param Company $company
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteClientCompany(Request $request, Company $company)
    {
        if ($id = $request->input('id')) {
            $company->findOrFail($id)->delete();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'messages' => [trans('company.company_is_required')]]);
    }
}
