<div class="form-group">
                                    <label for="product_title"> Name </label>
                                    <p>{{$product->product_title}}</p>
                                </div>

                                <div class="form-group">
                                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}">

                                </div>
                                

                                <div class="form-group">
                                <label for="zone_id">Suppliyer</label>
                                <select   required class="form-control select2 " name="supply_id" id="supply_id">
                                    <option value="" >Select Option</option>
                                    @foreach($suppliers as $supplier)
                                        <option   value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                     </div>

                                <div class="form-group ">
                                    <label for="stock">Quntity<span class="required">*</span></label>
                                    <input required type="number" class="form-control" name="stock" id="stock"    value=""  >
                                    <input   type="hidden" class="form-control" name="product_id_s" id="product_id_s"    value="{{$product->product_id }}"  >
                                    
                                </div>