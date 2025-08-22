<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return response()->json($barang,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($category)
    {
        $barang = Barang::where('category', $category)->get();
        if ($barang->isEmpty()) {
            return response()->json("not found", 404);
        } else {
            return response()->json($barang, 200);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'category' => 'required|string|max:255',
        ]);

        $barang = new Barang;
        $barang->name = $validated['name'];
        $barang->price = $validated['price'];
        $barang->description = $validated['description'] ?? null;
        $barang->image = $validated['image'] ?? null;
        $barang->category = $validated['category'];
        $success = $barang->save();

        if (!$success) {
            return response()->json("Error", 500);
        } else {
            return response()->json($barang, 201);
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);
        if (is_null($barang)) {
            return response()->json("not found", 404);
        } else {
            return response()->json($barang,200);
        }
        
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
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'category' => 'sometimes|required|string|max:255',
        ]);

        $barang = Barang::find($id);
        if (!$barang) {
            return response()->json("not found", 404);
        }
        
        if (array_key_exists('name', $validated)) $barang->name = $validated['name'];
        if (array_key_exists('price', $validated)) $barang->price = $validated['price'];
        if (array_key_exists('description', $validated)) $barang->description = $validated['description'];
        if (array_key_exists('image', $validated)) $barang->image = $validated['image'];
        if (array_key_exists('category', $validated)) $barang->category = $validated['category'];

        $success = $barang->save();

        if (!$success) {
            return response()->json("Error", 500);
        } else {
            return response()->json($barang, 200);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        if (is_null($barang)) {
            return response()->json("Error Not Found", 404);
        } 
        $success = $barang->delete();
        if (!$success) {
            return response()->json("Error Delete", 500);
        }else{
            return response()->json(null, 200);
        }
    }
}
