<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">
    <a href="/" class="site-logo" aria-label="<?php echo __('Home Page');?>">
        <img class="site-logo__img" src="https://dev-to-uploads.s3.amazonaws.com/uploads/logos/resized_logo_UQww2soKuUsjaOGNB38o.png" alt="<?php echo __('Home Page');?>">
    </a>
    

</nav>

<nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">
    <!-- Topbar Navbar -->
    <ul class="navbar-nav mr-auto">

        <!-- Nav Item - Messages -->
        <li class="nav-item  no-arrow mx-1">
            <a class="nav-link text-white " href="/" id="homelink" role="button"
                data-toggle="" aria-haspopup="true" aria-expanded="false">
                Home
            </a>
        </li>
        <!-- Nav Item - Messages -->
        <li class="nav-item  no-arrow mx-1">
            <a class="nav-link text-white" href="/fleamarket" id="homelink" role="button"
                data-toggle="" aria-haspopup="true" aria-expanded="false">
                FleaMarket
            </a>
        </li>
        <!-- Nav Item - Messages -->
        <li class="nav-item  no-arrow mx-1">
            <a class="nav-link text-white" href="/jobs" id="homelink" role="button"
                data-toggle="" aria-haspopup="true" aria-expanded="false">
                Jobs
            </a>
        </li>
        <!-- Nav Item - Messages -->
        <li class="nav-item  no-arrow mx-1">
            <a class="nav-link text-white" href="/goods" id="homelink" role="button"
                data-toggle="" aria-haspopup="true" aria-expanded="false">
                Goods
            </a>
        </li>
        <!-- Nav Item - Messages -->
        <li class="nav-item  no-arrow mx-1">
            <a class="nav-link text-white" href="/account" id="homelink" role="button"
                data-toggle="" aria-haspopup="true" aria-expanded="false">
                My Account
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        @auth
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline small text-white">{{auth()->user()->name}}</span>
                <?php if(auth()->user()->image == ""){ ?>
                <img src="{{asset('admin/img/undraw_profile.svg')}}" class="img-profile rounded-circle" alt="User-Profile-Image"> 
                <?php }else{ ?>
                <img src="/profile/{{ auth()->user()->image}}" class="img-profile rounded-circle" alt="User-Profile-Image"> 
                <?php } ?>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="overview">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
        @endauth
        @guest
        <li class="nav-item  no-arrow mx-1">
            <a class="nav-link text-white" href="/login" id="homelink" role="button"
                data-toggle="" aria-haspopup="true" aria-expanded="false">
                Log in
            </a>
        </li>
        @endguest
    </ul>

</nav>