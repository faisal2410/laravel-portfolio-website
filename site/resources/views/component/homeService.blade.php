<div class="container section-marginTop text-center">
    <h1 class="section-title">সার্ভিস সমূহ </h1>
    <h1 class="section-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
    <div class="row">
        @foreach($servicesData as $servicesData)
        <div class="col-md-3 p-2 ">
            <div class="card service-card text-center w-100">
                <div class="card-body">
                    <img class="service-card-logo " src="{{ $servicesData->serviceImg }}" alt="Card image cap">
                    <h5 class="service-card-title mt-3">{{ $servicesData->serviceName }}</h5>
                    <h6 class="service-card-subTitle p-0 m-0">{{ $servicesData->serviceDes }} </h6>
                </div>
            </div>
        </div>
        @endforeach   

    </div>
</div>
