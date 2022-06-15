@extends('layouts.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Product Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action={{ route('admin.category.store') }}>
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="category_name"
                        placeholder="Enter category name">
                    @error('category_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Category Desc</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="category_desc"
                        placeholder="Enter category description">
                    @error('category_desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
