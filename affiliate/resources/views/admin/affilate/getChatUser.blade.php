     <ul class="users">


        <!--                        --><?php
        //                              echo '<pre>';
        //                        print_r($users);exit();
        //                        ?>
        @foreach($users as $key=>$user)

        <?php
         $affiliate=DB::table('users_public')->select('name','email','picture')->where('id','=',$user->affiliate_id)->first();

             if($affiliate){
           $unread=DB::table('messages')->where('affiliate_id',$user->affiliate_id)->where('is_read','=',0)->count();

              if($affiliate->picture){
                  $picture=$affiliate->picture;
              } else{
                  $picture='user.png';
              }
         ?>
        <li class="user" id="{{ $user->affiliate_id }}">

            @if($unread >0)
            <span class="pending">{{$unread }}</span>
            @endif

            <div class="media">
                <div class="media-left">
                    <img src="{{url('/')}}/public/uploads/{{ $picture}}" alt="" class="media-object">
                </div>

                <div class="media-body">
                    <p class="name">{{ $affiliate->name }}</p>
                    <p class="email">{{ $affiliate->email }}</p>
                </div>
            </div>
        </li>
         <?php }?>
        @endforeach
    </ul>
