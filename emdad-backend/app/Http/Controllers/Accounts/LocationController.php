<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Services\AccountServices\LocationService;
use App\Http\Requests\AccountRequests\Location\CreateLocationRequest;
use App\Http\Requests\AccountRequests\Location\UpdateLocationRequest;
use App\Http\Requests\AccountRequests\Location\GetByLocationIdRequest;
use App\Http\Requests\AccountRequests\Location\RestoreLocationRequest;

class LocationController extends Controller
{
    protected $locationService;
 
    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\AccountServices\LocationService  $locationService
     * @return void
     */
    public function __construct(LocationService $locationService)
    {
        $this->LocationService = $locationService;
    }

    public function saveLocation(CreateLocationRequest $request)
    {
        return $this->locationService->createCompany($request);
    }

    public function updateLocation(UpdateLocationRequest $request)
    {
        return $this->locationService->update($request);
    }

    public function getAllLocations()
    {
        return $this->locationService->getAll();
    }

    public function getByLocationById(GetByLocationIdRequest $request,$id)
    {
        return $this->locationService->getById($id);
    }

    public function deleteLocation(GetByLocationIdRequest $request,$id)
    {
        return $this->locationService->delete($id);
    }
    
    public function restoreByLocationId(RestoreLocationRequest $request,$id)
    {
        return $this->locationService->restore($id);
    }
}