@extends('layout.app')
@section('title','Contact')
@section('content')
<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
                <img class=" page-top-img fadeIn" src="images/knowledge.svg">
                <h1 class="page-top-title mt-3">- যোগাযোগ করুন -</h1>
        </div>
    </div>    
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 mt-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.9614849599593!2d91.90886061432083!3d24.89929534983355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3750536177a1e017%3A0x5d0fd06ae5e92162!2sSiddiquey%20Plaza!5e0!3m2!1sen!2sbd!4v1628154114159!5m2!1sen!2sbd" width="550" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="col-md-6 mt-5">            
                <h3 class="service-card-title">ঠিকানা</h3>
                <hr>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> লিড এডুকেয়ার, ৩য় তলা, সিদ্দীকি প্লাজা, মেজরটিলা, সিলেট <i class="fas ml-2 fa-phone"></i>০১৭৯৮৩৯৩০৭৭ <br> <i class="fas fa-envelope"></i>  faisal2410@Yahoo.com </p>
                
           
                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button id="contactSendBtnId" class="btn btn-block normal-btn w-100 mt-5">পাঠিয়ে দিন </button>
        
        </div>
    </div>
</div>



@endsection