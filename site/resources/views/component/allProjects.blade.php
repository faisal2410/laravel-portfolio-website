<div class="container mt-5">
    <div class="row">

        @foreach ($projectsData as $projectsData )
        <div class="col-md-3 p-1 text-center">
            <div class=" m-1 card">
                <div class="text-center">
                    <img class="w-100" src="{{ $projectsData->projectImg }}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{ $projectsData->projectName }} </h5>
                    <h6 class="service-card-subTitle p-0 m-0">{{$projectsData->projectDesc}} </h6>
                    <a href="{{ $projectsData->projectLink }}" target="_blank" class="normal-btn mt-2 mb-4 btn">বিস্তারিত</a>
                </div>
            </div>
        </div>
            
        @endforeach
        

        

     



      

      

    </div>
</div>