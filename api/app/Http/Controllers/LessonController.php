<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Controllers\Controller;
use App\lesson;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 1. All is bad

        // 2. No way to attach meta data

        // 3. Linking db structure to the API output

        // 4. No way to signal headers/response codes

        $lessons = lesson::all();

        return response()->json([
            'data' => $this->transformCollection($lessons)],200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateLessonRequest $request)
    {
        $values = $request->only(['title', 'body','confirmed']);
        lesson::create($values);
        return response()->json(['message' => 'Added Recored'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $lessons = lesson::find($id);

        if(! $lessons) {
            return response()->json([
                'error' => [
                    'message' => 'Lesson does not exist',
                    'code'    => '404',
                    'urlError' => 'chrissu.design'
                ]
            ], 404);

        }

        return response()->json([
            'data' => $this->transform($lessons->toArray())
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CreateLessonRequest $request, $id)
    {
        $lessons = lesson::find($id);
        if(! $lessons) {
            return response()->json([
                'error' => [
                    'message' => 'Lesson does not exist',
                    'code'    => '404',
                    'urlError' => 'chrissu.design'
                ]
            ], 404);
        }
        $title = $request->get('title');
        $body  = $request->get('body');
        $confirmed = $request->get('confirmed');
        $lessons->title = $title;
        $lessons->body = $body;
        $lessons->confirmed = $confirmed;
        $lessons->save();
        return response()->json(['message' => 'Recore has been updated!'],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $lessons = lesson::find($id);
        if(! $lessons) {
            return response()->json([
                'error' => [
                    'message' => 'Lesson does not exist',
                    'code'    => '404',
                    'urlError' => 'chrissu.design'
                ]
            ], 404);
        }

        $lessons->delete();
        return response()->json(['message' => 'Recore has been deleted!'],201);
    }

    private function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'body'  => $lesson['body'],
            'confirmed' => (boolean)$lesson['confirmed'],
            'created_at' => $lesson['created_at'],
            'updated_at' => $lesson['updated_at']
        ];
    }

    private function transformCollection($lessons)
    {
        return array_map([$this, 'transform'], $lessons->toArray());
    }
}
