<aside id="sidebar" class="sidebar">
    <container class=" h-100 d-flex flex-column justify-content-between">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{route('admin.dashboard')}}">
                    <i class="fa-solid fa-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->



            <li class="nav-heading">Pagine</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="fa-solid fa-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin.accounts.edit', Auth::id())}}">
                    <i class="fa-solid fa-wrench"></i>
                    <span>Modifica il profilo</span>
                </a>
            </li><!-- End Message Page Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Messaggi</span>
                </a>
            </li><!-- End Contact Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="fa-solid fa-thumbs-up"></i>
                    <span>Recensioni</span>
                </a>
            </li><!-- End Login Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="fa-solid fa-cart-plus"></i>
                    <span>Sponsor</span>
                </a>
            </li><!-- End Login Page Nav -->


        </ul>

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item d-flex  align-items-center ">
                <span><i class="fa-solid fa-right-from-bracket txt-dark"></i></span>
                <span>
                    <a class="nav-link collapsed txt-dark fs-5" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </span>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </container>
</aside>
