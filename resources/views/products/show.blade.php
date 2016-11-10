@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $product->name }}</h1>

    <div class="row">
      <div class="col-md-8">

        <h3>Descripción</h3>
        <p>{{ $product->description }}</p>

        <h3>Precio</h3>
        <p>{{ $product->price }}</p>

        <h3>Categoría</h3>
        <p>{{ $product->category->value }}</p>

        <h3>Materiales</h3>

        <ul>
          @foreach($product->materials as $material)
            <li>{{ $material->value }}</li>
          @endforeach
        </ul>

      </div>

      <div class="col-md-4">
        <div class="row">
          @forelse($product->images as $image)
            <div class="col-md-6">
              <img src="/content/{{ $image->src }}" alt="{{ $product->name }}" class="img-responsive" />
            </div>
          @empty
            <h3>
              No hay imágenes cargadas.
            </h3>
          @endforelse
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <form action="/products/{{$product->id}}/images" class="dropzone" method="post">
          {{ csrf_field() }}
          <div class="fallback">
            <input name="file" type="file" multiple />
          </div>
        </form>
      </div>
    </div>

  </div>

@endsection

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
@endsection
