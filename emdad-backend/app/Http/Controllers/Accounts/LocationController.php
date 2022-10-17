<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Services\AccountServices\LocationService;
use App\Http\Requests\AccountRequests\Location\CreateLocationRequest;
use App\Http\Requests\AccountRequests\Location\UpdateLocationRequest;
use App\Http\Requests\AccountRequests\Location\GetByLocationIdRequest;
use App\Http\Requests\AccountRequests\Location\RestoreLocationRequest;
use App\Http\Requests\AccountRequests\Location\VerfiedLocationRequest;

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
        $this->locationService = $locationService;
    }

    public function saveLocation(CreateLocationRequest $request)
    {
        return $this->locationService->save($request);
    }

    public function updateLocation(UpdateLocationRequest $request)
    {
        return $this->locationService->update($request);
    }

    public function getAllLocations()
    {
        return $this->locationService->getAll();
    }

    public function getByLocationByCompanyId(GetByLocationIdRequest $request,$id)
    {
        return $this->locationService->showByCompanyId($id);
    }

    public function getByLocationByUserId(GetByLocationIdRequest $request,$id)
    {
        return $this->locationService->showByUserId($id);
    }

    public function getByLocationById(GetByLocationIdRequest $request,$id)
    {
        return $this->locationService->showById($id);
    }

    public function deleteLocation(GetByLocationIdRequest $request,$id)
    {
        return $this->locationService->delete($id);
    }
    
    public function restoreByLocationId(RestoreLocationRequest $request,$id)
    {
        return $this->locationService->restore($id);
    }

    public function verfiedLocation(VerfiedLocationRequest $request)
    {
        return $this->locationService->verfied($request);
    }
}