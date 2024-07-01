
      
      <style>
.add-cart-inner{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    border: 1px solid red;
    padding: 4px;
    padding-top: 4px;
    padding-top: 4px;
    margin-top: 6px; 
    padding-top: 7px;
    border-radius: 20px;
    cursor: pointer;
 
    
}
.add-cart-inner-show{
    border: 1px solid red;
padding-top: 9px;
display: flex;
justify-content: space-evenly;
height: 37px;
color: black;
cursor: pointer;
margin-top: 6px;
}
     </style>
      <script>
       
       function show_hide_item(product_id){
                 $("#main_show_item_"+product_id).css({"display":"none"});
                 $("#main_show_cart_item_"+product_id).css({"display":"block"});
                 AddTOCartPlusMinus(product_id,1);

            }

            function countDown(product_id){
                let quantity=parseInt($("#product_count_"+product_id).text());
                if (quantity > 1) {
                quantity = quantity - 1;
               
            } else{
                return true;
            }
            
            $("#product_count_"+product_id).text(quantity);
            AddTOCartPlusMinus(product_id,quantity);
            }


        function countUp (product_id){

         let quantity=parseInt($("#product_count_"+product_id).text());
         if (quantity) {
                quantity = quantity + 1;
            }           
         $("#product_count_"+product_id).text(quantity);
         AddTOCartPlusMinus(product_id,quantity);

        }

         
        function AddTOCartPlusMinus(product_id,quntity){
            $.ajax({
            type: "GET",
            url: "{{url('AddTOCartPlusMinus')}}",
            data:{product_id,quntity},
            success: function (data) {
                $('#cart_count').text(data.result.count);
                $('.total-price .value').text(data.result.total);
            }
        })
        }
        </script>
