<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        $comments = \App\Comment::where(['book_id'=>$book->id])->get();
        
        return response()
            ->json([
            'data' => $comments
        ], 201);
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
    public function store(CommentRequest $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('body');
        $comment->user()->associate($request->user());
        $book = Book::find($request->get('book_id'));
        $comment->save();

        
            return response()
            ->json([
            'message' => 'Success',
            'comments' => $comment
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = DB::table('comments')->where('id', $id)->first();
        return response()->json($comment, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $comment = $this->comment->get()->where('user_id',Auth::User()->id);
        if(!$comment->isEmpty()){
            return response()->json([
                'message' => 'Success, found data!',
                'data' => $comment
            ], 200);

        } else{
            return response()->json([
                'message' => 'Success but not found data!'
            ], 200); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComment $request, $id)
    {
        $comment = DB::table('comments')->where('id', $request->id)->update(['body' => $request->body]);

        return response()->json([
            'message' => 'Success, data updated!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $comment = DB::table('comments')->where('id', $request->id)->delete();

        return response()->json([
            'message' => 'Success, data deleted!'], 200);
    }
}
