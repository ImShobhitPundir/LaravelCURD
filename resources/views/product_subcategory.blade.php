                        <select name="sub_category_id" id="subcategory" class="form-control">
                            <option value="">Select Sub Category</option>
                            @foreach($data as $row)
                            <option value="{{ $row->id }}">{{ $row->sub_category_name }}</option>
                            @endforeach
                        </select>