<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Home</li>

                <li>
                    <a href="javascript:toggleview('dash')">
                        <i data-feather="airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="#peoples-menu" data-toggle="collapse">
                        <i data-feather="user"></i>
                        <span> Peoples </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="peoples-menu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="javascript:toggleview('newflr')">
                                    New Followers
                                </a>
                            </li>
                            <li>
                                <a href="javascript:toggleview('newunflr')">
                                    New UnFollowers
                                </a>
                            </li>
                            <li>
                                <a href="javascript:toggleview('imnotfb')">
                                    I'm Not FollowingBack
                                </a>
                            </li>
                            <li>
                                <a href="javascript:toggleview('arenotfb')">
                                    Are Not FollowingBack
                                </a>
                            </li>
                            <li>
                                <a href="javascript:toggleview('bothside')">
                                    Both Side
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title mt-2">Deep Dive</li>


                <li>
                    <a href="#tools-menu" data-toggle="collapse">
                        <i data-feather="cpu"></i>
                        <span> Tools </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="tools-menu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="javascript:toggleview('retweeters')">Get Retweeters</a>
                            </li>
                            <li>
                                <a href="javascript:toggleview('converter')">Get User Id/Name</a>
                            </li>
                            <li>
                                <a href="javascript:toggleview('relations')">Get 2 User's Relation</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Get Quoted tweet</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="javascript:void(0)">
                        <span class="badge badge-pink float-right">4.9K</span>
                        <i data-feather="thumbs-up"></i>
                        <span> Your likes </span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)">
                        <span class="badge badge-info float-right">3.2K</span>
                        <i data-feather="twitter"></i>
                        <span> Your Tweets </span>
                    </a>
                </li>

                
                <!--
                <li>
                    <a href="apps/social-feed.php">
                        <i data-feather="link"></i>
                        <span> single link </span>
                    </a>
                </li>

                <li>
                    <a href="apps/social-feed.php">
                        <span class="badge badge-pink float-right">bedge</span>
                        <i data-feather="link"></i>
                        <span> single link 2 </span>
                    </a>
                </li>
                -->


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->

<script>
    function toggleview(view)
    {
        dash.show = newflr.show = newunflr.show = imnotfb.show = arenotfb.show = bothside.show = retweeters.show = converter.show = relations.show = false;

        if(view=='newflr') newflr.show = true;
        else if(view=='newunflr') newunflr.show = true;
        else if(view=='imnotfb') imnotfb.show = true;
        else if(view=='arenotfb') arenotfb.show = true;
        else if(view=='bothside') bothside.show = true;
        else if(view=='retweeters') retweeters.show = true;
        else if(view=='converter') converter.show = true;
        else if(view=='relations') relations.show = true;
        else dash.show = true;

    }
</script>