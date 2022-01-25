<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Chapters;
use App\Models\Courses;

class ChaptersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // https://laracasts.com/discuss/channels/eloquent/all-vs-get-laravel-eloquent
        // get all data / filter data
        
        if ($request->query('course_id')) {
            $chapters = Chapters::where('course_id', $request->query('course_id'))->get();            
        } else {
            $chapters = Chapters::all();
        }

        return response()->json([
            'status' => true,
            'data' => $chapters
        ], 200);
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
            'course_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $course = Courses::find($request->input('course_id'));

        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => 'course not found'
            ], 404);
        }

        $chapter = Chapters::create($request->all());

        return response()->json([
            'status' => true,
            'data' => $chapter
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
        $chapter = Chapters::find($id);
        if (!$chapter) {
            return response()->json([
                'status' => false,
                'message' => 'chapter not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $chapter
        ], 200);
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
            'course_id' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $chapter = Chapters::find($id);

        if (!$chapter) {
            return response()->json([
                'status' => false,
                'message' => 'chapter not found'
            ], 404);
        }

        if ($request->input('course_id')) {
            $course = Courses::find($request->input('course_id'));

            if (!$course) {
                return response()->json([
                    'status' => false,
                    'message' => 'course not found'
                ], 404);
            }
        }

        $chapter->update($request->all());
    
        return response()->json([
            'status' => true,
            'data' => $chapter
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
        $chapter = Chapters::find($id);

        if (!$chapter) {
            return response()->json([
                'status' => false,
                'message' => 'chapter not found'
            ], 404);
        }

        $chapter->delete();

        return response()->json([
            'status' => true,
            'message' => 'chapter deleted'
        ], 200);
    }
}
