<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genres;

class GenresController extends Controller
{
    public function list()
    {
        $items = Genres::orderBy('name', 'asc')->get();

        return view(
            'genres.list',
            [
                'title' => 'Žanrs',
                'items' => $items,
            ]
        );
    }
    public function create()
    {
        return view(
            'genres.form',
            [
                'title' => 'Pievienot jaunu žanru',
                'genres' => new Genres(),
            ]
        );
    }

    // save new genres
    public function put(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $genres = new Genres();
        $genres->name = $validatedData['name'];
        $genres->save();

        return redirect('/genres');
    }
}
