@if(isset($medias))
    <?php $i=0;?>
    @foreach ($medias as $category)
        <tr>
            <td>{{ $category->media_id }}</td>
            <td>{{$category->media_title}} </td>
            <td>{{$category->product_code}} </td>
            <td>
                <?php if($category->product_code==null) {?>
                    <img width="30" src="{{ url('/public') }}/{{$category->media_path}}">
                <?php }  else { ?>
                <img width="30" src="{{ url('/public') }}/{{$category->media_path}}">
                <?php } ?>

            </td>
            <td>

                <input type="text"   id="url_{{ $category->media_id }}"  value="<img  class='img-responsive' src='{{ url('/public') }}/{{$category->media_path}}' />">
                <input type="button"  id="{{ $category->media_id  }}" class="btn btn-success copy_class" value="Copy"> </td>

            <td>{{date('d-m-Y h:i:s a',strtotime($category->created_time))}}</td>
            <td>
                  <a title="delete" href="{{ url('admin/media/delete') }}/{{ $category->media_id }}" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
                    <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                </a>
            </td>
        </tr>

    @endforeach

    <tr>
        <td colspan="7" align="center">
            {!! $medias->links() !!}
        </td>
    </tr>
@endif

