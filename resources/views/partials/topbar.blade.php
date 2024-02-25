<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="http://localhost:5174/" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">BDoctors</span>
        </a>
        <i class="fa-solid fa-list toggle-sidebar-btn"></i>
        <a href="http://localhost:5174/" class=" d-flex align-items-center">
            <div class="pic2 d-lg-block d-none "><img class="img-fluid " src="/images/Bdoctor.png" alt="hello"></div>
            <span class="d-lg-none fs-3 txt-b fw-bold  d-block mx-3">BDoctors</span>
            {{--  <span class="d-none d-lg-block text-danger mx-4"><i class="fa-solid fa-user-doctor"></i></span> --}}
        </a>
    </div><!-- End Logo -->

    <div class="search-bar d-none">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Cerca..." title="Enter search keyword">
            <button type="submit" title="Search"><i class="fa-solid fa-search"></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-none d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="fa-solid fa-search"></i>
                </a>
            </li>
            </li>

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                    <i class="fa-solid fa-circle-user"></i>
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('admin.accounts.show', Auth::id()) }}">
                            <i class="fa-solid fa-person"></i>
                            <span>Profilo</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fa-solid fa-gear"></i>
                            <span>Impostazioni Account</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fa-solid fa-question-circle"></i>
                            <span>Hai bisogno di aiuto?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="d-flex px-3  align-items-center ">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                            {{ __('Esci') }}
                        </a>
                        </span>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
