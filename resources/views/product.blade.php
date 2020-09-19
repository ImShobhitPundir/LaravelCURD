@extends('layouts.admin')

@section('content')
  

<script>
   
        function showSub(val){
            $.ajax({
                url: "/demo/public/ajax-subcat",
                type:"POST",
                data:{
                    cat_id:val,
                    _token: '{{csrf_token()}}'
                },
                success:function(response){
                //console.log(response);
                $(".subcategory").html(response);
                },
            });
        }

</script>

<script>
   function addFields(val){
       //alert('jkjk');
    //e.preventDefault();
    $("#price").append("<div class='form-group col-lg-4'><select name='color[]' class='form-control'><option value=''>Select Color</option><option value='Red'>Red</option><option value='Green'>Green</option><option value='Blue'>Blue</option><option value='Yellow'>Yellow</option></select></div>");
    $("#price").append("<div class='form-group col-lg-4'><select name='quantity[]' class='form-control'><option value=''>Select Max Quantity</option><option value='10'>10</option><option value='50'>50</option><option value='75'>75</option><option value='100'>100</option></select></div>");
    $("#price").append("<div class='form-group col-lg-4'><input type='number' class='form-control' placeholder='Price' name='price[]'></div>");
  }

</script>
<!-- <h1 class="h3 mb-0 text-gray-800">Add Category</h1> -->
<div class="row">

<div class="col-xl-12 col-lg-12 py-2">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                  <div class="dropdown text-primary">
                    <a  href="{{ route('product.index') }}">  <i class="fa fa-eye"></i> View Product</a>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                @if($errors->any())
                <div class="alert alert-success">
                  {{$errors->first()}}
                </div>
                  
                @endif
                <form class="user" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <select name="category_id" id="category"  class="form-control" onchange="showSub(this.value)">
                            <option value="">Select Category</option>
                            @foreach($data as $row)
                            <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div class="form-group subcategory">
                        <select name="subcategory_id" id="sub_category_id" class="form-control">
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>
                   
                    <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="">Product Name</label>
                      <input type="text" class="form-control" placeholder="Product Name" name="product_name">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="">Trade Name</label>
                      <input type="text" class="form-control" placeholder="Trade Name" name="trade_name">
                    </div>
                    
                    <div class="form-group col-lg-6">
                        <label for="">Finish</label>
                      <input type="text" class="form-control" placeholder="Finish" name="finish">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Product Code</label>
                      <input type="text" class="form-control" placeholder="Product Code" name="product_code">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Sort Description</label>
                      <textarea class="form-control" placeholder="Sort Description" name="sort_description"></textarea>
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Description</label>
                      <textarea class="form-control" placeholder="Description" name="description"></textarea>
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Weave</label>
                      <input type="text" class="form-control" placeholder="Weave" name="weave">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">GSM</label>
                      <input type="text" class="form-control" placeholder="GSM" name="gsm">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Mac Price</label>
                      <input type="number" class="form-control" placeholder="Max Price" name="max_price">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Location</label>
                      <input type="text" class="form-control" placeholder="Location of Product" name="location">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Certificate</label>
                      <input type="text" class="form-control" placeholder="Certificate" name="certificate">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Blend</label>
                      <input type="text" class="form-control" placeholder="Blend" name="blend">
                    </div>                    
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for=""><strong> Dimension(cm) </strong></label>
                    </div>
                        <div class="form-group col-lg-4">
                        <label for="">Length</label>
                            <input type="number" class="form-control" placeholder="Length" name="length">
                        </div>
                        <div class="form-group col-lg-4">
                        <label for="">Width</label>
                            <input type="number" class="form-control" placeholder="Width" name="width">
                        </div>
                        <div class="form-group col-lg-4">
                        <label for="">Height</label>
                            <input type="number" class="form-control" placeholder="Height" name="height">
                        
                        </div>
                        <div class="form-group col-lg-12">
                            <input id="image" type="file" name="image" class="form-control">
                        </div>
                    
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <!-- <div class="form-group col-lg-12">
                            <input type="file" class="form-control" name="image">
                        </div> -->

                    </div>

                    <div class="row" id="price">
                        <div class="form-group col-lg-12">
                            <label for=""><strong> Price </strong></label>
                    </div>
                        <div class="form-group col-lg-4">
                            <select name="color[]" class="form-control">
                                <option value="">Select Color</option>
                                <option value="Red">Red</option>
                                <option value="Green">Green</option>
                                <option value="Blue">Blue</option>
                                <option value="Yellow">Yellow</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <select name="quantity[]" class="form-control">
                                <option value="">Select Max Quantity</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="number" class="form-control" placeholder="Price" name="price[]">
                        </div>

                      


                    </div>
                    <div id="addMore" style="cursor:pointer;" onclick="addFields()"> <img src="{{ asset('asset/plus.png') }}" alt="" width="50px"> </div></br></br></br>


                    
                    <input type="submit" class="btn btn-primary" value="add">
                
                  </form>
                </div>
              </div>
            </div>


</div>
@endsection
