@extends('layouts.admin')

@section('content')
        
<!-- <h1 class="h3 mb-0 text-gray-800">Add Category</h1> -->
<div class="row">

<div class="col-xl-12 col-lg-12 py-2">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">View Product</h6>
                  <div class="dropdown text-primary">
                    <a  href="{{ route('product.create') }}">  <i class="fa fa-plus"></i> Add Product</a>
                  </div>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                @if($errors->any())
                <div class="alert alert-success">
                  {{$errors->first()}}
                </div>
                  
                @endif

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
          <td>S.No.</td>
          <td>Cat</td>
          <td>Sub Cat</td>
          <td>Product Name</td>
          <td>Max Price</td>
          <td>Image</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
       @php
        $count = 1
        @endphp
        @foreach($data as $row)
        

        <tr>
            <td>{{$count}}</td>
            <td>{{$row->category_name}}</td>
            <td>{{$row->sub_category_name}}</td>
            <td>{{$row->product_name}}</td>
            <td>{{$row->max_price}}</td>
            <td><img src="<?= str_replace("public","",url('/')); ?>/storage/app/public/uploads/<?= $row->image ?>" width="100px"/></td>
            <td class="text-center">
            <a href="{{ route('product.show', $row->id)}}" class="btn btn-success btn-sm"> View </a>
                <a href="{{ route('product.edit', $row->id)}}" class="btn btn-primary btn-sm"> Edit </a>
                <form action="{{ route('product.destroy', $row->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @php $count++ @endphp
        @endforeach
    </tbody>
  </table>
               
                </div>
              </div>
            </div>


</div>
@endsection
