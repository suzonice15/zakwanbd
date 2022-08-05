<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
</head>
<body>


@php
                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                $redColor = [255, 0, 0];
            @endphp 

            <div   style="width:100%"> 
                   <h4>Product Name:{{$product_row->product_title}}</h4>
                   <h5 style="text-align:center;margin-to:-5px">Code:{{$product_row->sku}}</h5> 
                    @for($i=0;$i <$total;$i++)
                            <div   style="padding:2px;width:20%;float:left"> 
                                    {!! $generator->getBarcode($product_row->barcode ? $product_row->barcode : " nai", $generator::TYPE_CODE_128 ,1, 40) !!}
                                    <p style="font-weight:bold;text-align:center;width:100%;margin-top:0px">{{$product_row->barcode}}</p> 
                            </div>

                    @endfor

            </div>

            </body>
</html>