@extends('layouts.master')
@section('pageTitle')
    Product Bar Code Generate
@endsection
@section('mainContent')
<div class="box-body">  
    <div class="row">
    <form action="{{url('/')}}/admin/productBarCodeGenerate" method="get"  >
       <div class="col-md-5"> 
                <div class="form-group"  >
                    <label>Product Name</label> 
                    <select name="product_id" id="product_id" class="form-control select2"> 
                        <option  value="" >Select Option</option> 
                        @foreach($products as $product)
                        <option @if($product_id ==$product->product_id) selected @endif value="{{$product->product_id}}">{{$product->product_title}}-({{$product->sku}})</option> 
                        @endforeach
                    </select>
                </div> 
        </div>

        <div class="col-md-2  ">
                <label>Bar Code Quantity</label> 
                    <input readonly type="number"  name="barcode_quantity" placeholder="example :125" value="1"  class="form-control" >
        </div> 
        
        <div class="col-md-1  " style="margin-top:25px">
                <label></label> 
                     <input type="submit"  name="pdf"   class="form-control btn btn-primary pull-right"   value="download"    />
        </div>
</form> 

    </div>



    <div class="row" id="printableArea" >
            @php
                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                $redColor = [255, 0, 0];
            @endphp 

            @if($total > 0)
                    @for($i=0;$i <$total;$i++)
                            <div   style="padding:5px;width:20%;float:left">
                                    <div class="image">
                                    {!! $generator->getBarcode($product_row->barcode ? $product_row->barcode : " nai", $generator::TYPE_CODE_128,2, 40) !!}
                                    <p style="font-weight:bold;text-align:center;">{{$product_row->barcode}}</p>
                                        </div>
                        
                            </div>

                    @endfor
            @endif
</div>
    
</div> 
@endsection

