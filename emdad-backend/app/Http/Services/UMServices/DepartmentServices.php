<?php

namespace App\Http\Services\UMServices;

use App\Models\Department;

class DepartmentServices
{

    public function AddDepartment($request)
    {
        Department::create($request);

        return response()->json( [ 'message'=>'department created successfully' ], 200 );
    }
}
