@extends('website.master')
@section('mainContent')

<style>
   .fun-facts-inner {
  width: 100%;
border-radius: 8px;
background-color: #ffffff;
box-shadow: 0 8px 18px 0 rgba(0,0,0,0.18);
padding: 30px;
position: absolute;
top: 30px;
left: 0;
z-index: 100
}

.desktop_image{
    background-image: url(https://www.sohojbuy.com/storage/sohojaffiliates.jpg) !important;background-position: center top;
        background-repeat:no-repeat !important;
        height: 533px;
}
.image_class{
    display:none;
}

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}


   @media only screen and (min-width: 1100px) {
       .fun-facts-inner h2{font-size: 28px;text-align: center;}
   }
   @media (max-width: 776px) {
       .fun-facts-info {
           border-right: 0px solid #ddd;
           text-align: center;
           border-bottom: 1px solid #ddd;
       }
       .justify-content-center {
           display: block !important;

       }
       .image_class{
           display: block !important;
           width: 100%;
           height: 405px;
       }
   }

    .justify-content-center{
        display: flex;flex-direction: row;justify-content: center
    }
</style>
 <section class="callaction bg-image">
        <div class="container remove_class desktop_image">
            <div class="row">
                
                <img  class="img-fluid image_class" src="https://www.sohojbuy.com/public/mobile.jpg">
                
                
                <div class="col-lg-5 col-md-5">

                    <h1  class="mother_heading"  >বাংলাদেশের নাম্বার ১
                        অ্যাফিলিয়েট প্ল্যাটফর্ম
                    </h1>

                    <h3 class="mother_heading_bottom" >মাতৃভাষায় অ্যাফিলিয়েট মার্কেটিং
                        ।</h3>
                        
                        <br/>
                    <a href="{{url('/')}}/registration" class="start_now"
                    > এখনি শুরু করুন </a>


                </div>
                <div class="col-lg-4 col-md-4">
                   
                </div>
            </div>
        </div>
    </section>
    <section id="content">
        <div class="container">
            <div class="row justify-content-center" >
    
            <div class="col-12 col-md-10 col-lg-7" >
                <div class="fun-facts-inner ext wow fadeInUp" data-wow-duration=".7s" style="visibility: visible; animation-duration: 0.7s; animation-name: fadeInUp;">
                	                    <div class="row">
                                                <div class="col-12 col-md-4">
                            <div class="fun-facts-info">
                                <h2>{{$total_user}}</h2>
                                <p>অ্যাফিলিয়েট ইউজার</p>
                            </div>
                        </div>
                                                <div class="col-12 col-md-5">
                            <div class="fun-facts-info">
                                <h2 style="margin-left: -32px;">৳
                                    {{number_format(round($total_income), 2)}}
                                </h2>

                                <p>অ্যাফিলিয়েট ইনকাম  </p>
                            </div>
                        </div>
                                                <div class="col-12 col-md-3">
                            <div class="fun-facts-info" style="border-right:1px solid white">
                                <h2>{{$total_product}}+</h2>
                                <p>প্রোডাক্ট</p>
                            </div>
                        </div>
                                            </div>
             </div>
            </div>


               
            </div>


        </div>
    </section>


    <section>
        <div class="container why_you_work_inaffilite">
            
            
               <h1 class="why_affilite_work" >কেন সহজ এফিলিয়েটসে কাজ করবেন ?</h1>


            <div class="row">

             
                <div class="col-md-3">

                    <center><img src="https://www.sohojbuy.com/public/uploads/free.png" style="width:80px;height:60px;">
                        <h4>ফ্রী এবং সহজ</h4></center>
                    <p>সহজ এফিলিয়েটে কাজ শুরু করতে কোন টাকা পয়সা লাগেনা। স্টেপ বাই স্টেপ গাইডলাইন
                        এবং টারগেট আপনাকে এগিয়ে নিয়ে যাবে কাঙ্খিত লক্ষ্যে।</p>


                </div>

                <div class="col-md-3">

                    <center><img src="https://www.sohojbuy.com/public/uploads/invite.png"
                                 style="width:80px;height:60px;">
                        <h4>ইনভাইট এন্ড প্রমোট</h4></center>
                    <p>আপনার সাইট, ফেসবুক পেজ, গ্রুপ বা ইউটিউব চ্যানেলের ভিজিটরকে টাকায় পরিনত করুন। অন্যদের এফিলিয়েট
                        প্রোগ্রামে ইনভাইট করে আজীবন বাড়তি ১০% কমিশন আয় করুন।</p>


                </div>
                <div class="col-md-3">

                    <center><img src="https://www.sohojbuy.com/public/uploads/states.png"
                                 style="width:70px;height:60px;">
                        <h4>ট্র্যাক এন্ড এনালাইজ</h4></center>
                    <p>ড্যাসবোর্ডে দেখতে পাবেন কোন প্রডাক্টের ফলাফল ভালো হচ্ছে কোনটা হচ্ছেনা। আপনি নিজের ঠিক করতে পারবেন
                        আপনার সফলতার জন্য কি করা উচিত। এছাড়া আমাদের মেন্টর আপনাকে দেবে ফ্রীতেই দিক নির্দেশনা।</p>


                </div>
                <div class="col-md-3">


                    <center><img src="https://www.sohojbuy.com/public/uploads/gift.png" style="width:60px;height:50px;">
                        <h4>কাজের পুরষ্কার নিন</h4></center>
                    <p>প্রতিটা সেল থেকে পাওয়া কমিশন মাত্র ৫০০ টাকা হলেই উত্তোলন করতে পারবেন। এছাড়াও প্রতিটা লেভেল রয়েছে
                        দারুন সব বোনাস।</p>


                </div>
            </div>

            
            <img  style="display: none" src="https://www.sohojbuy.com/public/uploads/Joining_Bonus.jpg" alt="Nature" class="responsive" width="100%" height="auto">
            




<br/><br/>

        </div>
    </section>


@endsection
