@extends('layouts.app')
@section('main')
  
      <div class="container">
        <div class="text-right">
             <a href="products/create" class="btn btn-primary mt-2">New Product </a>
        </div>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Sno.</th>
              <th>Name</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <td>{{ $loop->index+1 }}</td>
              <td><a href="/products/{{ $product->id }}/show" class="text-bold">{{ $product->name }}</a></td>
              <td>
                <img src="products/{{ $product->image }}" alt="" style="border-radius: 50%" width="50" height="50" />
              </td>
              <td>
                <a href="products/{{ $product->id }}/edit" class="btn btn-primary">Edit</a>
                <form action="products/{{ $product->id }}/delete" method="POST" style="display: inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

@endsection
