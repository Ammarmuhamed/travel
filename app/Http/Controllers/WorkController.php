<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use App\Http\Requests\WorkRequest;
use App\Http\Resources\WorkResource;
use Laravel\Scout\Searchable;


class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = Work::with('media')->get();
        
        // return $works;
        return WorkResource::collection($works);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkRequest $request)
    {
        $work = Work::create($request->validated());
        if(isset($request->image)){
            $work->addMedia($request->image)
            ->toMediaCollection();
        }

        return new WorkResource($work);
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        return new WorkResource($work);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(WorkRequest $request, Work $work)
    {
        $work->update($request->validated());
        if(isset($request->image)){
            $work->addMedia($request->image)
            ->toMediaCollection();
        }
        return new WorkResource($work);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return response()->json([
            'message' => 'record deleted successfully',
            'status' => 200,
        ]);
    }

    public function activate (Work $work)
    {
        $val = 0;
        if($work->is_active == 0 ){
          $val = 1;
        }
        $work->update([
            'is_active' => $val
        ]);
        return response()->json([
            'message' => 'record activated successfully',
            'status' => 200,
        ]);
    }


    
}
