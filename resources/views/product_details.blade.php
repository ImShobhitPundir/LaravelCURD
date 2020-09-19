@extends('layouts.admin')

@section('content')
        
<!-- <h1 class="h3 mb-0 text-gray-800">Add Category</h1> -->
<div class="row">

<div class="col-xl-12 col-lg-12 py-2">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Product Full Details</h6>
                  <div class="dropdown text-primary">
                    <a  href="{{ route('product.index') }}">  <i class="fa fa-arrow-alt-circle-left"></i> Back to list</a>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
               <h5>{{ $data[0]->product_name }}</h5>
               <table class="table border" border="1" >
                   <tr>
                       <td><img src="<?= str_replace("public","",url('/')); ?>/storage/app/public/uploads/<?= $data[0]->image ?>" width="100px"/></td>
                       <td> <b>Trade Name:</b> {{ $data[0]->trade_name }}</td>
                       <td> <b>Finish:</b> {{ $data[0]->finish   }} </td>
                       <td> <b>Product Code:</b> {{ $data[0]->product_code   }} </td>
                       <td> <b>Sort Description:</b> {{ $data[0]->sort_description   }} </td>
                       <td> <b>Description:</b> {{ $data[0]->description   }} </td>
                   </tr>
                   <tr>
                       <td> <b>Weave:</b> {{ $data[0]->weave }}</td>
                       <td> <b>GSM:</b> {{ $data[0]->gsm   }} </td>
                       <td> <b>Max Price:</b> Rs.{{ $data[0]->max_price   }} </td>
                       <td> <b>Location:</b> {{ $data[0]->location   }} </td>
                       <td> <b>Certificate:</b> {{ $data[0]->certificate   }} </td>
                       <td> <b>Blend:</b> {{ $data[0]->blend   }} </td>
                   </tr>
                   <tr>
                       <td> <b>Length:</b> {{ $data[0]->length }}cm.</td>
                       <td> <b>Width:</b> {{ $data[0]->width   }}cm.</td>
                       <td> <b>Height:</b> {{ $data[0]->height   }}cm.</td>
                   </tr>
               </table>
               <h5>Price Details</h5>
               <table class="table border" border="1">
                   <tr>
                       <th>Colour</th>
                       <th>Quantity</th>
                       <th>Price</th>
                   </tr>
                @foreach($price as $pr)
                   <tr>
                       <td>{{ $pr->color }}</td>
                       <td>{{ $pr->quantity }}</td>
                       <td>{{ $pr->price }}</td>
                       
                   </tr>
                @endforeach
               </table>
               
                </div>
              </div>
            </div>


</div>
@endsection
