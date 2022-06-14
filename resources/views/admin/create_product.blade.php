@extends('layouts.master')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Product</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Name</label>
          <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name">
          @error('product_name')
                    <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group" data-select2-id="29">
                  <label>Category</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="category_id">
                    <option data-select2-id="34">select</option>
                    @foreach($categories as $category)
                    <option data-select2-id="35" value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                  </select>
                              </div>
                              <div class="form-group">
                        <label>Enter Product description</label>
                        <textarea name="product_desc" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        @error('product_desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                       @enderror
                      </div>
                      <div class="form-group">
                    <label for="exampleInputFile">Upload Image</label>
                    <div class="input-group">
                    <input type="file"
                         id="avatar" name="image"
                           accept="image/png, image/jpeg">
                      </div>
                      <!-- <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> -->
                      <div>
                   
                   
                    </div>
                  </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
