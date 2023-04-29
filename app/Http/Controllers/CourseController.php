<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();
        return response()->json(['data'=>$course], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
                'name'=>'required|string',
                'description'=>'required|max:255',
                'units'=>'required|integer'
        ]);

        $course = Course::create($validated);

        return response()->json(['data' => $course], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $course = Course::find($id);
        if(!$course){
            return response()->json(['message'=> 'Course does not exist.'], 404);
        }
        return response()->json(['data'=>$course], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
                'name'=>'sometimes|string',
                'description'=>'sometimes|string|max:255',
                'units'=>'sometimes|integer'
        ]);

        $course = Course::find($id);
        $course->update($validated);

        return response()->json(['data'=>$course],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::find($id);        
        if(!$course){
            return response()->json(['message'=> 'Course does not exist.'], 404);
        }
        $course->delete();
        return response()->json(null,204);
    }
}
