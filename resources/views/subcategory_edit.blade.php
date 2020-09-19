@extends('layouts.admin')

@section('content')
        
<!-- <h1 class="h3 mb-0 text-gray-800">Add Category</h1> -->
<div class="row">

<div class="col-xl-12 col-lg-12 py-2">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Update Category</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                @if($errors->any())
                <div class="alert alert-success">
                  {{$errors->first()}}
                </div>
                  
                @endif
                <?php //print_r($data[0]); exit; ?>
                <form class="user" method="post" action="{{ route('subcategory.update', $data[0]->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            
                            @foreach($cat as $row)
                            <option value="{{ $row->id }}"  @if($data[0]->category_id == $row->id) selected  @endif >{{ $row->category_name }}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="" name="sub_category_name"  value="{{ $data[0]->sub_category_name }}">
                    </div>
                    
                    
                    <input type="submit" class="btn btn-primary" value="Update">
                
                  </form>
                </div>
              </div>
            </div>


</div>
@endsection
