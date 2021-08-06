<nav class="navbar fixed-top nav-before navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}"><img class="nav-logo" src="images/leadlogo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-3 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link nav-font" href="{{ url('/') }}">হোম </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-font" href="{{ url('/courses') }}">কোর্স সমুহ </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-font" href="{{ url('/projects') }}">প্রোজেক্ট </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-font" href="#">ব্লগ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-font" href="{{ url('/contact') }}">যোগাযোগ</a>
            </li>
        </ul>
   
    </div>
</nav>
