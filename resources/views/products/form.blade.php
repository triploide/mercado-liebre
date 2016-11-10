@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="/products" method="post" class="form-horizontal">
      {{ csrf_field() }}
      {{ method_field('post') }}

      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
      </div>

      <div class="form-group">
        <label for="price">Precio</label>
        <input type="text" name="price" value="{{ old('price') }}" class="form-control">
      </div>

      <div class="form-group">
        <label for="description">Descripción</label>
        <textarea name="description" rows="10" class="form-control">{{ old('description') }}</textarea>
      </div>

      <div class="form-group">
        <label for="name">Categoría</label>
        <select name="category_id" class="form-control">
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->value }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="name">Materiales</label>
        <br />
        @foreach($materials as $material)
          <div class="col-md-2">
            <input type="checkbox" name="materials[]"  value="{{$material->id}}" id="check{{$material->id}}"> <label for="check{{$material->id}}">{{$material->value}}</label>
          </div>
        @endforeach

      </div>

      <div class="form-group">
        <input type="submit" name="Enviar" class="btn btn-primary">
      </div>

    </form>
  </div>

@endsection
