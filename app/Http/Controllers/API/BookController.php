<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Book;
use  Validator ;
class BookController extends BaseController
{


public function index()
{
    $books = Book::all();
    return $this->sendResponse($books->toArray(), 'Books read succesfully');
}







public function store(Request $request)
{
    $input = $request->all();
    $validator =    Validator::make($input, [
    'name'=> 'required',
    'details'=> 'required'
    ]);

    if ($validator -> fails()){
        return $this->sendError('error validation', $validator->errors());
    }

    $book = Book::create($input);
    return $this->sendResponse($book->toArray(), 'Book  created succesfully');

}










public function show($id)
{
    $book = Book::find($id);
    if (   is_null($book)   ) {
        return $this->sendError('book not found !');
    }
    return $this->sendResponse($book->toArray(), 'Book read succesfully');

}





public function update(Request $request , Book $book)
{
    $input     = $request->all();
    $validator =    Validator::make($input, [
    'name'   => 'required',
    'details'=> 'required'
    ]);
    if ($validator -> fails()) {
        return $this->sendError('error validation', $validator->errors());
    }
    $book->name =  $input['name'];
    $book->details =  $input['details'];
    $book->save();
    return $this->sendResponse($book->toArray(), 'Book  updated succesfully');

}










public function destroy(Book $book)

{
    $book->delete();
    return $this->sendResponse($book->toArray(), 'Book  deleted succesfully');
}

}
