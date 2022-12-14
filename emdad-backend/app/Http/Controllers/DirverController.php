<?php

namespace App\Http\Controllers;

use App\Http\Requests\Driver\CreateDriverRequest;
use App\Http\Resources\Delviery\DriverResources\DriverResources;
use App\Models\Accounts\Driver;
use Illuminate\Http\Request;

class DirverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDriverRequest $request)
    {
        $dirvers = Driver::create([
            'name_ar' => $request->nameAr,
            'name_en' => $request->nameEn,
            'age' => $request->age,
            "nationality" => $request->nationality,
            "phone" => $request->phone
        ]);
        if ($dirvers) {
            return response()->json(['message' => "created Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dirver = Driver::find($id);
        if ($dirver) {
            return response()->json(['data' => DriverResources::collection($dirver)], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dirver = Driver::find($id);
        if ($dirver) {
            $dirver->update([
                'name_ar' => $request->nameAr ?? $dirver->name_ar,
                'name_en' => $request->nameEn ?? $dirver->name_en,
                'age' => $request->age ?? $dirver->age,
                "nationality" => $request->nationality ?? $dirver->nationality,
                "phone" => $request->phone ?? $dirver->phone
            ]);
            return response()->json(['message' => "updated Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dirver = Driver::find($id);
    
        if ($dirver) {
            $dirver->delete();
            return response()->json(['message' => "deleted Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function restore($id)
    {
        return $this->warehouseService->restore($id);
    }
}
