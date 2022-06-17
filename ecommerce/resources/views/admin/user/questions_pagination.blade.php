@if(isset($questions))
    <?php $i=$questions->perPage() * ($questions->currentPage()-1);?>
    @foreach ($questions as $question)

        <?php
        $product_title='';
        $product_name='';
      $product_data=  DB::table('product')->select('product_title','product_name')->where('product_id',$question->product_id)->first();
       if($product_data){
           $product_title=$product_data->product_title;
           $product_name=$product_data->product_name;
       }

        ?>
        <tr >
            <td>{{$question->comment_id}}</td>
            <td><a  target="_blank" href="{{url('/')}}/{{$product_name}}">{{$product_title}}</a> </td>
            <td>{{$question->comment_from_customer}}</td>
            <td>{{$question->comment_from_admin}}</td>
            <td>
                @if($question->staus==1)

                    <button type="button" class="btn btn-block btn-danger btn-xs">Not Answer</button>
                @else

                    <button type="button" class="btn btn-block btn-success btn-xs">Answered</button>


                @endif


            </td>
            <td>
                <a href="{{url('/')}}/admin/product/comment/{{$question->comment_id}}" class="btn btn-success ">Comment</a>
            </td>
        </tr>
    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $questions->links() !!}
        </td>
    </tr>
@endif


<script>

    function  messageSeen(comment_id){
        $.ajax({
            type:"GET",
            url:"{{url('admin/generel/message/show')}}/"+comment_id,
            success:function(data)
            {

            }
        })
    }

</script>
