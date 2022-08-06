<!-- Sidebar -->
<div class="sidebar">
			
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="assets/img/user.png" alt="user img" class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ session('Logged_in')['name'] }}
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="/profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="/security">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item @if($page == 'index') active @endif">
                    <a href="/">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item @if($page == 'projects') active @endif">
                    <a href="/projects">
                        <i class="fa fa-briefcase"></i>
                        <p>Projects</p>
                    </a>
                </li>
                <li class="nav-item @if($page == 'tasks') active @endif">
                    <a href="/tasks">
                        <i class="fa fa-tasks"></i>
                        <p>Tasks</p>
                    </a>
                </li>
                <li class="nav-item @if($page == 'profile') active @endif">
                    <a href="/profile">
                        <i class="fa fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item @if($page == 'security') active @endif">
                    <a href="/security">
                        <i class="fa fa-cog"></i>
                        <p>Security</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logout">
                        <i class="fa fa-power-off"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->