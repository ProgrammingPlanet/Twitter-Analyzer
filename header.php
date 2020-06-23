<!-- Topbar Start -->
<div class="navbar-custom" id="head">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">
    
            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>
    
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img :src="renderpic(user.profile)" alt="image" class="rounded-circle">
                    <!-- assets/images/users/user.jpg -->
                    <span class="pro-user-name ml-1">
                        {{user.name}} <i class="mdi mdi-chevron-down"></i> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title text-center">
                        <h6 class="text-overflow m-0">Your Account</h6>
                    </div>

                    <!-- item-->
                    <a class="dropdown-item notify-item">
                        <i class="fe-info"></i>
                        <span>{{user.name}}</span>
                    </a>

                    <!-- item-->
                    <a class="dropdown-item notify-item">
                        <i class="fe-twitter"></i>
                        <span>@{{user.username}}</span>
                    </a>
    
                    <!-- item-->
                    <a class="dropdown-item notify-item">
                        <i class="fe-user-check"></i>
                        <span>Followers: {{user.followers}}</span>
                    </a>
    
                    <!-- item-->
                    <a class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Following: {{user.followings}}</span>
                    </a>
    
                    <div class="dropdown-divider"></div>
    
                    <!-- item-->
                    <a class="dropdown-item notify-item" href="#" v-on:click="logout()"
                    >
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                
                    </a>
    
                </div>
            </li>            
    
        </ul>
    
        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.php" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="22">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo-dark.png" alt="" height="20">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>
    
            <a href="index.php" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo-light.png" alt="" height="20">
                </span>
            </a>
        </div>
    
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
           
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->

<script src="assets/js/header.js"></script>