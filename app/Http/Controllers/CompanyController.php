<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getCompanyName($company_id) {
        $company = Company::find($company_id);
        return response()->json(['company_name' => $company->company_name]);
    }
}
