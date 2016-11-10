@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Listado de productos</h1>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Categoría</th>
          <th>Precio</th>
          <th>Materiales</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->value }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->materials()->pluck('value')->implode(', ') }}</td>
            <td>
              <a href="/products/{{$product->id}}/edit">Editar</a>
              <form action="/products/{{$product->id}}" method="post" style="display: inline-block">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <input type="submit" name="Borrar" value="Borrar" class="btn btn-danger btn-xs" style="display: inline-block">
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

  </div>

@endsection
