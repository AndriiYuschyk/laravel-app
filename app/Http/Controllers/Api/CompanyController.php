<?php

namespace App\Http\Controllers\Api;

use App\Enums\CategoryVersionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function store(CompanyRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $company = Company::where('edrpou', trim($validatedData['edrpou']))->first();

        if (!$company) {
            $company = Company::create($validatedData);

            $companyVersion = $company->versions()->create([
                'company_id' => $company->id,
                'version' => $company->getNextVersionNumber(),
                'name' => $validatedData['name'],
                'edrpou' => $company->edrpou,
                'address' => $validatedData['address'],
            ]);

            return response()->json([
                'status' => CategoryVersionStatus::CREATED->value,
                'company_id' => $company->id,
                'version' => $companyVersion->version,
            ], 201);
        }

        $hasChanges = $company->name !== $validatedData['name']
            || $company->address !== $validatedData['address'];

        if ($hasChanges) {
            $company->update($validatedData);

            $companyVersion = $company->versions()->create([
                'company_id' => $company->id,
                'version' => $company->getNextVersionNumber(),
                'name' => $validatedData['name'],
                'edrpou' => $company->edrpou,
                'address' => $validatedData['address'],
            ]);

            return response()->json([
                'status' => CategoryVersionStatus::UPDATED->value,
                'company_id' => $company->id,
                'version' => $companyVersion->version,
            ], 200);
        }

        return response()->json([
            'status' => CategoryVersionStatus::DUPLICATE->value,
            'company_id' => $company->id,
            'version' => $company->latestVersion()->version,
        ], 200);
    }
}
