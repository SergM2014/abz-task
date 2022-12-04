<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:1024|dimensions:min_width=300,min_height=300',
        ]);

        return redirect()->back();

    }
}
