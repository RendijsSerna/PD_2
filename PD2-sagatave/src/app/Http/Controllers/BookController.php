<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Http\Requests\BookRequest;


class BookController extends Controller
{
    public function list()
    {
     $items = Book::orderBy('name', 'asc')->get();
     return view(
     'book.list',
     [
     'title' => 'Grāmatas',
     'items' => $items
     ]
     );
    }
    public function create()
{
 $authors = Author::orderBy('name', 'asc')->get();
 return view(
 'book.form',
 [
 'title' => 'Pievienot grāmatu',
 'book' => new Book(),
 'authors' => $authors,
 ]
 );
}
private function saveBookData(Book $book, BookRequest $request)
{
 $validatedData = $request->validate([
 'name' => 'required|min:3|max:256',
 'author_id' => 'required',
 'description' => 'nullable',
 'price' => 'nullable|numeric',
 'year' => 'numeric',
 'image' => 'nullable|image',
 'display' => 'nullable'
 ]);

 $book->name = $validatedData['name'];
 $book->author_id = $validatedData['author_id'];
 $book->description = $validatedData['description'];
 $book->price = $validatedData['price'];
 $book->year = $validatedData['year'];
 $validatedData = $request->validated();
 if ($request->hasFile('image')) {
 $uploadedFile = $request->file('image');
 $extension = $uploadedFile->clientExtension();
 $name = uniqid();
 $book->image = $uploadedFile->storePubliclyAs(
 '/',
 $name . '.' . $extension,
 'uploads'
 );
 }
 $book->save();
}
public function put(BookRequest $request)
{
 $book = new Book();
 $this->saveBookData($book, $request);
 return redirect('/books');
}
public function patch(Book $book, BookRequest $request)
{
 $this->saveBookData($book, $request);
 return redirect('/books/update/' . $book->id);
}
public function update(Book $book)
{
 $authors = Author::orderBy('name', 'asc')->get();
 return view(
 'book.form',
 [
 'title' => 'Rediģēt grāmatu',
 'book' => $book,
 'authors' => $authors,
 ]
 );
}

public function delete(Book $book)
{
 $book->delete();
 return redirect('/books');
}

}
