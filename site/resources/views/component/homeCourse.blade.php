<div class="container section-marginTop text-center">
    <h1 class="section-title">কোর্স সমূহ </h1>
    <h1 class="section-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
    <div class="row">
        @foreach ($coursesData as $coursesData )
        <div class="col-md-4 thumbnail-container">
            <img src="{{ $coursesData->courseImg }}" alt="Avatar" class="thumbnail-image ">
            <div class="thumbnail-middle">
                <h1 class="thumbnail-title"> {{ $coursesData->courseName }} </h1>
                <h1 class="thumbnail-subtitle">{{ $coursesData->courseDes }} </h1>
                <h6 class="thumbnail-subtitle">{{ $coursesData->courseTotalClass }}</h6>
                <a target="_blank" href="{{ $coursesData->courseLink}}"class="normal-btn btn">শুরু করুন</a>
            </div>
    </div>
            
        @endforeach
        
       
 
    </div>
</div>