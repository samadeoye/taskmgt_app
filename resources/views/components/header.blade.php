<div class="main-header" data-background-color="purple">
    <!-- Logo Header -->
    <div class="logo-header">
        
        <a href="/" class="logo">
            <h6 class="navbar-brand text-white fw-bold">Task Mgt. App</h6>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-bars"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
        <div class="navbar-minimize">
            <button class="btn btn-minimize btn-rounded">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg">
        
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="assets/img/user.png" alt="user img" class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="assets/img/user.png" alt="profile img" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4>{{ session('Logged_in')['name'] }}</h4>
                                    <p class="text-muted"> {{ session('Logged_in')['email'] }}</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/profile">My Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/security">Account Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout">Logout</a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>