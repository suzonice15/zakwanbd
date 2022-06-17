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
            <div class="row justify-content-md-center" >

 <div class="col-md-1 col-lg-3">
     
     
 </div>
    
            <div class="col-11 col-md-8 col-lg-6">
                <div class="fun-facts-inner ext wow fadeInUp" data-wow-duration=".7s" style="visibility: visible; animation-duration: 0.7s; animation-name: fadeInUp;">
                	                    <div class="row">
                                                <div class="col-12 col-md-4">
                            <div class="fun-facts-info">
                                <h2>2500+</h2>
                                <p>অ্যাফিলিয়েট ইউজার</p>
                            </div>
                        </div>
                                                <div class="col-12 col-md-5">
                            <div class="fun-facts-info">
                                <h2>70,000+ টাকা </h2>
                                <p>অ্যাফিলিয়েট ইনকাম  </p>
                            </div>
                        </div>
                                                <div class="col-12 col-md-3">
                            <div class="fun-facts-info0">
                                <h2>500+</h2>
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
            
            
               <h1 class="why_affilite_work" >Terms and Condition</h1>


            


        </div>
    </section>


@endsection
