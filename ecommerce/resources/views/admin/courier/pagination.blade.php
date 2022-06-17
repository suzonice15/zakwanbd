@if(isset($categories))
    <?php $i=0;?>
    @foreach ($categories as $category)
        <tr>
            <td>{{ $category->category_id }}</td>

            <td>{{$category->category_title}} </td>
            <td>{{$category->category_name}} </td>
            <td><?php if($category->status==1) {echo "Publised" ;}else{ echo "Unpublished";} ?> </td>
            <td>{{date('d-m-Y',strtotime($category->registered_date))}}</td>
            <td>
                <a title="edit" href="{{ url('admin/category') }}/{{ $category->category_id }}">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>


                <a title="delete" href="{{ url('admin/category/delete') }}/{{ $category->category_id }}" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
                    <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                </a></td>
        </tr>

    @endforeach

    <tr>
        <td colspan="3" align="center">
            {!! $categories->links() !!}
        </td>
    </tr>
@endif


