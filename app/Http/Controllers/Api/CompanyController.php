<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a paginated list of companies.
     */
    public function index()
    {
        return response()->json(Company::paginate(10));
    }

    /**
     * Store a new company.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'nullable|email',
            'website'  => 'nullable|url',
            'logo'     => 'nullable|image|dimensions:min_width=100,min_height=100',
        ]);

        $data = $request->only(['name', 'email', 'website']);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company = Company::create($data);
        return response()->json(['success' => true, 'data' => $company], 201);
    }

    /**
     * Show a single company.
     */
    public function show($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }
        return response()->json($company);
    }

    /**
     * Update a company.
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        $company->update($request->all());
        return response()->json(['success' => true, 'data' => $company]);
    }

    /**
     * Delete a company.
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        $company->delete();
        return response()->json(['success' => 'Company deleted successfully']);
    }
}
