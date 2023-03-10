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
        if (is_null($barang)) {
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
        $barang = new Barang;
        $barang->name = $request->name;
        $barang->price = $request->price;
        $barang->description = $request->description;
        $barang->image = $request->image;
        $barang->category = $request->category;
        $success = $barang->save();

        if (!$success) {
            return response()->json("Error", 500);
        } else {
            return response()->json("Success", 201);
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
    public function update(Request $request)
    {
        $barang = Barang::find($request->id);
        $barang->name = $request->name;
        $barang->price = $request->price;
        $barang->description = $request->description;
        $barang->image = $request->image;
        $barang->category = $request->category;

        $success = $barang->save();

        if (!$success) {
            return response()->json("Error", 500);
        } else {
            return response()->json("Success", 201);
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
            return response()->json("Success", 201);
        }
    }
}
