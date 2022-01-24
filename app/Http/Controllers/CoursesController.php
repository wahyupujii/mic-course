<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Courses;
use App\Models\Mentors;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // biar bisa pagination
        $courses = Courses::query();
        return response()->json([
            'status' => true,
            'data' => $courses->paginate(3)
        ], 200);

        // yang biasa 
        // $courses = Courses::all();
        // return response()->json([
        //     'status' => true,
        //     'data' => $courses
        // ], 200);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'certificate' => 'required|boolean',
            'thumbnail' => 'string|url',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'integer',
            'level' => 'required|in:all-level,beginner,intermediate,advance',
            'description' => 'string',
            'mentor_id' => 'required|integer' 
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $mentor = Mentors::find($request->input('mentor_id'));

        if (!$mentor) {
            return response()->json([
                'status' => false,
                'message' => 'mentor not found'
            ], 404);
        }

        $course = Courses::create($request->all());

        return response()->json([
            'status' => true,
            'data' => $course
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'certificate' => 'boolean',
            'thumbnail' => 'string|url',
            'type' => 'in:free,premium',
            'status' => 'in:draft,published',
            'price' => 'integer',
            'level' => 'in:all-level,beginner,intermediate,advance',
            'description' => 'string',
            'mentor_id' => 'integer' 
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $course = Courses::find($id);

        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => 'course not found'
            ], 404);
        }

        if ($request->input('mentor_id')) {
            $mentor = Mentors::find($request->input('mentor_id'));
            if (!$mentor) {
                return response()->json([
                    'status' => false,
                    'message' => 'mentor not found'
                ], 404);
            }   
        }

        $course->update($request->all());

        return response()->json([
            'status' => true,
            'data' => $course
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Courses::find($id);

        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => 'course not found'
            ], 404);
        }

        $course->delete();

        return response()->json([
            'status' => true,
            'message' => 'course deleted',
        ], 200);
    }
}
