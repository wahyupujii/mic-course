<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentors;
use Illuminate\Support\Facades\Validator;

class MentorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mentors = Mentors::all();
        return response()->json([
            'status' => true,
            'data' => $mentors
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
            'profile' => 'required|url',
            'email' => 'required|email',
            'profession' => 'required|string'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $mentor = Mentors::create($request->all());
        
        return response()->json([
            'status' => true,
            'data' => $mentor
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
        $mentor = Mentors::find($id);

        // kalau pake whereId => hasil nya nanti tetep {}
        // $mentor = Mentors::whereId($id);

        if (!$mentor) {
            return response()->json([
                'status' => false,
                'message' => 'mentor not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $mentor
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
            'profile' => 'url',
            'email' => 'email',
            'profession' => 'string'
        ]);
        
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        // jika seperti ini, return yang dihasilkan hanya boolean 1 / 0
        // $mentor = Mentors::whereId($id)->update($request->all());
        
        $mentor = Mentors::find($id);

        if (!$mentor) {
            return response()->json([
                'status' => false,
                'message' => 'mentor not found'
            ], 404);
        }

        // $mentor->fill($request->all());
        $mentor->update($request->all());

        return response()->json([
            'status' => true,
            'data' => $mentor
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
        $mentor = Mentors::find($id);

        if (!$mentor) {
            return response()->json([
                'status' => false,
                'message' => 'mentor not found'
            ], 404);
        }

        $mentor->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'mentor success deleted'
        ], 200);
    }
}
