<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use  App\Http\Resources\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(Book::all());
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
    public function store(Request $request)
    {
        /*$faker= \Faker\Factory::create(1);
        $book= Book::create([
            'name'=> $faker->name,
            'description'=> $faker->sentence,
            'year'=> $faker->year
        ]);

        return new BookResource($book);*/

        $book = Book::create([
            'name'        => $request->name,
            'description' => $request->description,
            'year'        => $request->year
        ]);
       
        $data                = array();
        $data['message']     = ' Book created successfully';
        $data['name']        = $book->name;
        $data['description'] = $book->description;
        $data['year']        = $book->year;
        $data['id']          = $book->id;

        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*$book->update([
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),
            'year'=> $request->input('year')
        ]);

        return new BookResource($book);*/

        $book = Book::find($id);
        //dd($book);
        $book->update([
            'name'        => $request->name ?? $book->name,
            'description' => $request->description ?? $book->description,
            'year' => $request->year ?? $book->year
        ]);

        
        $data                = array();
        $data['message']     = 'Book has been updated.';
        $data['name']        = $book->name;
        $data['description'] = $book->description;
        $data['year']        = $book->year;
        $data['id']          = $book->id;

        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response(null, 204);
    }
}
