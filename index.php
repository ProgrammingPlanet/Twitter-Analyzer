<?php

    require 'auth/twitteroauth/autoload.php';
    require 'auth/conf.php';

    use TwitterOAuth\TwitterOAuth;

    session_start();

    if(!isset($_SESSION[SESSION_NAME])) header('Location: auth/login.php');

    $tw = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$_SESSION[SESSION_NAME]['token'],$_SESSION[SESSION_NAME]['secret']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
    <!-- App favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.css" rel="stylesheet" type="text/css">

    <!-- <script src="assets/js/libs/vue-v2.6.11.min.js"></script> -->
    <script src="assets/js/libs/vue-debug.js"></script>
    <script src="assets/js/libs/axios-v0.19.2.min.js"></script>
    <script src="assets/js/utilities.js"></script>
    <style>
        .fade-enter-active,.fade-leave-active {
            transition: opacity 1s
        }

        .fade-enter,.fade-leave-to {
            opacity: 0
        }
    </style>

</head>

<body>
    <!-- Begin page -->
    <div id="wrapper"> 
        <?php include('header.php') ?>
        <?php include('sidebar.php') ?>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content"> 
                <?php 
                    include('dashboard.php');  
                    include('peoples/newfollowers.php');
                    include('peoples/newunfollowers.php'); 
                    include('peoples/imnotfb.php'); 
                    include('peoples/arenotfb.php'); 
                    include('peoples/bothside.php'); 
                    include('tools/retweeters.php');
                    include('tools/converter.php');
                    include('tools/relations.php');
                ?>
            </div>
            <!-- content -->
            <?php /*include('footer.php')*/ ?>
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- bundle -->
    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>
    <!-- Dashboar 1 init js-->
    <script src="assets/js/pages/dashboard.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script src="assets/js/dashboard.js"></script>
    
</body>

</html>
