@extends('layouts.app')
@section('main')

      <div class="container">
        <h1 class="text-muted">Product Edit #{{ $product->name }}</h1>
        <div class="row justify-content-center">
            <div class="col-sm-8">
            <div class="card mt-3 p-3">
                <form action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>product Name :</label>
                      <input type="text" class="form-control" name="name" value="{{ old('name',$product->name)}}">
                      @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                        <label >Description:</label>
                        <textarea type="text" class="form-control rows-4" name="description">{{ old('description', $product->description)}}</textarea>
                        @if($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                      @endif
                      </div>
                    <div class="form-group">
                      <label>Image:</label>
                      <input type="file" class="form-control " name="image" value="{{ old('image')}}">
                      @if($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                      @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            </div>
        </div>
      </div>
@endsection