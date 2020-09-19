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
                  <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
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
                <form class="user" method="post" action="{{ route('product.update', $data[0]->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <select name="category_id" id="category"  class="form-control" onchange="showSub(this.value)">
                            <option value="">Select Category</option>
                            @foreach($cat as $row)
                            <option value="{{ $row->id }}"  @if($data[0]->category_id == $row->id) selected  @endif >{{ $row->category_name }}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div class="form-group subcategory">
                        <select name="sub_category_id" id="sub_category_id" class="form-control">
                            <option value="">Select Sub Category</option>
                            @foreach($subcat as $row)
                            @if($data[0]->sub_category_id == $row->id)
                            <option value="{{ $row->id }}" selected>{{ $row->sub_category_name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="">Product Name</label>
                      <input type="text" class="form-control" placeholder="Product Name" name="product_name" value="{{ $data[0]->product_name }}">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="">Trade Name</label>
                      <input type="text" class="form-control" placeholder="Trade Name" name="trade_name" value="{{ $data[0]->trade_name }}">
                    </div>
                    
                    <div class="form-group col-lg-6">
                        <label for="">Finish</label>
                      <input type="text" class="form-control" placeholder="Finish" name="finish" value="{{ $data[0]->finish }}">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Product Code</label>
                      <input type="text" class="form-control" placeholder="Product Code" name="product_code" value="{{ $data[0]->product_code }}">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Sort Description</label>
                      <textarea class="form-control" placeholder="Sort Description" name="sort_description">{{ $data[0]->sort_description }}</textarea>
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Description</label>
                      <textarea class="form-control" placeholder="Description" name="description">{{ $data[0]->description }}</textarea>
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Weave</label>
                      <input type="text" class="form-control" placeholder="Weave" name="weave"  value="{{ $data[0]->weave }}">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">GSM</label>
                      <input type="text" class="form-control" placeholder="GSM" name="gsm"  value="{{ $data[0]->gsm }}">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Mac Price</label>
                      <input type="number" class="form-control" placeholder="Max Price" name="max_price"  value="{{ $data[0]->max_price }}">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Location</label>
                      <input type="text" class="form-control" placeholder="Location of Product" name="location"  value="{{ $data[0]->location }}">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Certificate</label>
                      <input type="text" class="form-control" placeholder="Certificate" name="certificate"  value="{{ $data[0]->certificate }}">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="">Blend</label>
                      <input type="text" class="form-control" placeholder="Blend" name="blend"  value="{{ $data[0]->blend }}">
                    </div>                    
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for=""><strong> Dimension(cm) </strong></label>
                    </div>
                        <div class="form-group col-lg-4">
                        <label for="">Length</label>
                            <input type="number" class="form-control" placeholder="Length" name="length"  value="{{ $data[0]->length }}">
                        </div>
                        <div class="form-group col-lg-4">
                        <label for="">Width</label>
                            <input type="number" class="form-control" placeholder="Width" name="width"  value="{{ $data[0]->width }}">
                        </div>
                        <div class="form-group col-lg-4">
                        <label for="">Height</label>
                            <input type="number" class="form-control" placeholder="Height" name="height"  value="{{ $data[0]->height }}">
                        
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
                    @foreach($detail as $dt)
                        <div class="form-group col-lg-4">
                            <select name="color[]" class="form-control">
                                <option value="">Select Color</option>
                                <option value="Red" @if($dt->color == "Red") selected  @endif>Red</option>
                                <option value="Green" @if($dt->color == "Green") selected  @endif>Green</option>
                                <option value="Blue" @if($dt->color == "Blue") selected  @endif>Blue</option>
                                <option value="Yellow" @if($dt->color == "Yellow") selected  @endif>Yellow</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <select name="quantity[]" class="form-control">
                                <option value="">Select Max Quantity</option>
                                <option value="10" @if($dt->quantity == "10") selected  @endif>10</option>
                                <option value="50" @if($dt->quantity == "50") selected  @endif>50</option>
                                <option value="75" @if($dt->quantity == "75") selected  @endif>75</option>
                                <option value="100" @if($dt->quantity == "100") selected  @endif>100</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="number" class="form-control" placeholder="Price" name="price[]" value="{{ $dt->price }}">
                        </div>
                        @endforeach

                      


                    </div>
                    <div id="addMore" style="cursor:pointer;" onclick="addFields()"> <img src="{{ asset('asset/plus.png') }}" alt="" width="50px"> </div></br>


                    
                    <input type="submit" class="btn btn-primary" value="Update">
                
                  </form>
                </div>
              </div>
            </div>


</div>
@endsection
