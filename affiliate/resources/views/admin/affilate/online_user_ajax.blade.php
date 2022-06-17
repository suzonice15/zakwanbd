
<?php

if($affilates){
foreach($affilates as $row ){



?>

<tr>

    <td>{{$row->id}}</td>
    <td>{{$row->name}}</td>

    <td>{{$row->email}}</td>
    <td>{{$row->phone}}</td>
    <td>{{$row->address}}</td>


    <td><?php echo  date('h:i a',strtotime($row->login_time)) ?></td>



</tr>

<?php
}


} ?>
