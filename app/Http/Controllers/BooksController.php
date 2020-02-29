<?php

namespace App\Http\Controllers;

use App\Book;
use App\traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller;

class BooksController extends Controller
{
    use ApiResponder;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index() :JsonResponse
    {
        $books = Book::all();

        return $this->successResponse($books, Response::HTTP_OK);
    }

    public function store(Request $request) :JsonResponse
    {
        $rules = [
            'title'       => 'required|max:255',
            'description' => 'required|max:255',
            'price'       => 'required|min:0',
            'author_id'   => 'required|min:1',
        ];
        $this->validate($request, $rules);
        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    public function show($book) :JsonResponse
    {
        $book = Book::findOrFail($book);

        return $this->successResponse($book);
    }

    public function update(Request $request, $book) :JsonResponse
    {
        $rules = [
            'title'       => 'max:255',
            'description' => 'max:255',
            'price'       => 'min:0',
            'author_id'   => 'min:1',
        ];

        $this->validate($request, $rules);
        $book = Book::findOrFail($book);
        $book->fill($request->all());

        if ($book->isClean()) {
            return $this->errorResponse('At least one value should change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();

        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    public function destroy($book) :JsonResponse
    {
        $book = Book::findOrFail($book);
        $book->delete();

        return $this->successResponse($book);
    }
}
