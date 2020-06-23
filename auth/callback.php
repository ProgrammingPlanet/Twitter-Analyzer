<?php

    require 'twitteroauth/autoload.php';
    require 'conf.php';
    require '../dbcon.php';
    require '../utilities.php';

    use TwitterOAuth\TwitterOAuth;

    session_start();

    function attempt_login($acc_token,$acc_secret)
    {
        $tw = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$acc_token,$acc_secret);
        
        $user = $tw->get('account/verify_credentials');

        if(property_exists($user,'errors')) return FALSE; // not loged in
            
        return $user->id_str;
    }


    function handle_callback($verifier)
    {
        // setup connection to twitter with request token
        $tw = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$_SESSION['oauth_token'],$_SESSION['oauth_token_secret']);
        
        // get an access token
        $access_token = $tw->oauth('oauth/access_token',['oauth_verifier'=>$verifier]);

        unset($_SESSION['oauth_token'],$_SESSION['oauth_token_secret']);

        return $access_token;
    }


    
    if(isset($_GET['oauth_verifier']) && isset($_GET['oauth_token']) && isset($_SESSION['oauth_token'])) //from callback
    {
        if($_GET['oauth_token'] == $_SESSION['oauth_token']) //valid callback
        {
            $access = handle_callback($_GET['oauth_verifier']);
            $access = ['token'=>$access['oauth_token'],'secret'=>$access['oauth_token_secret']];

            try{
                $user_id = attempt_login($access['token'],$access['secret']);

                if($user_id)
                {
                    $at = $access['token'];
                    $as = $access['secret'];
                    $t = time();

                    $q = "SELECT cookie FROM users WHERE twitter_id='$user_id'";
                    $cv = $db->query($q)->fetch(PDO::FETCH_COLUMN);

                    if($cv) //user is login before or on another device
                    {
                        $q = "UPDATE users SET token='$at',secret='$as',last_login='$t' WHERE twitter_id='$user_id'";
                    }
                    else{
                        $cv = GenrateId($db,'users','cookie',40);
                        $q = "INSERT INTO users(twitter_id,followers,following,blocking,cookie,token,secret,last_login) 
                        VALUES('$user_id','[]','[]','[]','$cv','$at','$as','$t')";

                        $db->query("INSERT INTO user_data_history(id) VALUES('$user_id')");
                    }

                    $db->query($q);
                    setcookie(COOKIE_NAME,$cv,time()+COOKIE_EXPIRY_TIME,'/');

                    $access['id'] = $user_id;
                    
                    $_SESSION[SESSION_NAME] = $access;

                    header('Location: ../index.php');
                    exit;
                }
                else{
                    $error = 'Error occur in getting twitter id. Try Again.';
                }
                
            }
            catch(Exception $e){
                $error = $e->getMessage();
            }
        }
        else{
            $error = 'invalid callback, try login again.';
        }
        
        unset($_SESSION[SESSION_NAME]);
        die("<script>alert('Error: ".addslashes($error)."');window.location.href='login.php';</script>");
    }
    else //not log in
    {
        unset($_SESSION[SESSION_NAME]);
        header('Location: login.php');
    }
