<?php

namespace App\Http\Controllers\emdad;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\GetRelatedCompanyRequest;
use App\Http\Resources\General\RelatedCompaiesResource;
use App\Http\Services\General\WathiqService;
use App\Models\Emdad\RelatedCompanies;
use Illuminate\Http\Request;

class WathiqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRelatedCompanies(GetRelatedCompanyRequest $request, WathiqService $service)
    {
        $related = RelatedCompanies::where("identity", $request->id)->where("identity_type", $request->type)->get();

        if (sizeOf($related) > 0) {
            return response()->json(["status" => true, "data" => RelatedCompaiesResource::collection($related)], 200);
        } else {
            $service->getRelatedCompanies($request->id, $request->type);
            $related = RelatedCompanies::where("identity", $request->id)->where("identity_type", $request->type)->get();
            return response()->json(["status" => true, "data" => RelatedCompaiesResource::collection($related)], 200);
        }
    }
}
