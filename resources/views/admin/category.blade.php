@extends('layouts.master')
@section('content')
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Product Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter category name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Category Desc</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter category description">
                  </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            @endsection