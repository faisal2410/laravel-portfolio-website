<div class="container mt-5">
    <div class="row">
        @foreach ($coursesData as $coursesData )
        <div class="col-md-4 p-1 text-center">
            <div class="card">
                <div class="text-center">
                    <img class="w-100" src="{{ $coursesData->courseImg }}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{ $coursesData->courseName }}</h5>
                    <h6 class="service-card-subTitle p-0 ">{{ $coursesData->courseDes }} </h6>
                    <h6 class="service-card-subTitle p-0 ">{{ $coursesData->courseFee }}{{ $coursesData->courseTotalEnroll }} </h6>
                    <a href="{{ $coursesData->courseLink }}" target="_blank" class="normal-btn-outline mt-2 mb-4 btn">শুরু করুন </a>
                </div>
            </div>
        </div>            
        @endforeach
     

     
      


      




    </div>
</div>