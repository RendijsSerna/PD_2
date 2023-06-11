<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    // display all directors
    public function list()
    {
        $items = Author::orderBy('name', 'asc')->get();

        return view(
            'author.list',
            [
                'title' => 'Autori',
                'items' => $items,
            ]
        );
    }


 public function create()
{
 return view(
 'author.form',
 [
 'title' => 'Pievienot autoru'
 ]
 );
}
public function put(Request $request)
{
 $validatedData = $request->validate([
 'name' => 'required',
 ]);
 $author = new Author();
 $author->name = $validatedData['name'];
 $author->save();
 return redirect('/authors');
}
}

