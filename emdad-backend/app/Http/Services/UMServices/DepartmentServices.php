<?php

namespace App\Http\Services\UMServices;

use App\Models\Department;

class DepartmentServices
{

    public function AddDepartment($request)
    {
        $db=Department::create($request);

        //use the same approch for other service (Murtuada) 

        $db->users()->attach($db->id,['user_id'=>2,'company_info_id'=>3]);
        


        return response()->json( [ 'message'=>'department created successfully' ], 200 );
    }
}
