<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::visibles()->where('user_id', \Auth::id())->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all();
        $materials = \App\Material::all();
        return view('products.form', compact('categories', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = \Auth::user()->products()->create($request->all());
        /*
        $data = $request->all();
        $data['user_id'] = \Auth::id();
        $product = Product::create($data);
        */
        $product->materials()->sync($request->input('materials'));
        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = \App\Category::all();
        $materials = \App\Material::all();
        return view('products.form-edit', compact('categories', 'materials', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        $product->materials()->sync($request->input('materials'));
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //Product::destroy($id);

        foreach ($product->images as $image) {
          //borrar los archivo imagen
          \Storage::delete($image->src);
          //borrar las filas imagen
          $image->delete();
        }
        //pasar el product a inactivo
        $product->visible = 0;
        $product->save();

        return redirect('products');
    }

    public function borrarPorLote(Request $request)
    {
      //Product::whereIn('id', $request->input(ids))->delete();
      Product::whereIn('id', $request->input(ids))->update(['visible' => 0]);
    }

    public function images(Request $request, $id)
    {
      //guardo el archivo
      $product = Product::find($id);
      $file = $request->file('file');
      $ext = $file->extension();
      $name = uniqid();
      $file->storeAs('images/products-'.$product->id, $name.'.'.$ext);

      //persiste en base
      $image = new \App\Image(['src' => 'images/products-'.$product->id.'/'.$name.'.'.$ext]);
      $product->images()->save($image);
    }
}
