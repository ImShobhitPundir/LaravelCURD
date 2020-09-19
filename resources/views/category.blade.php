@extends('layouts.admin')

@section('content')
        
<!-- <h1 class="h3 mb-0 text-gray-800">Add Category</h1> -->
<div class="row">

<div class="col-xl-12 col-lg-12 py-2">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                  <div class="dropdown text-primary">
                    <a  href="{{ route('category.index') }}">  <i class="fa fa-eye"></i> View Category</a>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                @if($errors->any())
                <div class="alert alert-success">
                  {{$errors->first()}}
                </div>
                  
                @endif
                <form class="user" method="post" action="{{ route('category.store') }}">
                    @csrf
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Enter Category Name..." name="category_name">
                    </div>
                    
                    
                    <input type="submit" class="btn btn-primary" value="add">
                
                  </form>
                </div>
              </div>
            </div>


</div>
@endsection
