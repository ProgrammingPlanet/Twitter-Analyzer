<?php
	
	session_start();

	require 'twitteroauth/autoload.php';
    require 'conf.php';
    require '../dbcon.php';

    use TwitterOAuth\TwitterOAuth;


    function genrate_login_url()
    {
        // connect to twitter with our app creds
        $tw = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET);

        // get a request token from twitter
        $req_token = $tw->oauth('oauth/request_token',['oauth_callback'=>OAUTH_CALLBACK]);

        // save twitter token info to the session for verify access token
        $_SESSION['oauth_token'] = $req_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $req_token['oauth_token_secret'];

        $url = $tw->url('oauth/authorize',['oauth_token'=>$req_token['oauth_token']]);

        return $url;
    }

    function attempt_login($acc_token,$acc_secret)
    {
        $tw = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$acc_token,$acc_secret);
        
        $user = $tw->get('account/verify_credentials');

        if(property_exists($user,'errors')) return FALSE; // not loged in
            
        return TRUE;
    }

	function cookie_login()
    {
        global $db;

        if(isset($_COOKIE[COOKIE_NAME]))
        {
            $cookie_val = $_COOKIE[COOKIE_NAME];
            $q = "SELECT twitter_id,token,secret FROM users WHERE cookie='$cookie_val'";
            $data = $db->query($q)->fetch(PDO::FETCH_ASSOC);
            if($data)
            {
                if(attempt_login($data['token'],$data['secret']))
                {
                    $_SESSION[SESSION_NAME] = ['token'=>$data['token'],'secret'=>$data['secret'],'id'=>$data['twitter_id']];
                    return TRUE;
                }
            }
        }

        return FALSE;
    }

    function session_login()
    {
    	return isset($_SESSION[SESSION_NAME]) ? TRUE : FALSE;
    }


    if(session_login() || cookie_login())
	{
		header('Location: ../index.php');
		exit;
	} 
    else
    {
    	$login_url = genrate_login_url();
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">

		html, body {
		  height: 100%;
		  max-height: 100%;
		  margin: 0;
		  padding: 0;
		}

		.flex-container {
		  display: flex;
		  height: 100%;
		}

		.container {
		  display: flex;
		  margin: auto;
		}

	</style>
</head>
<body>
	<div class="flex-container">
	    <div class="container">
			<a href="<?=$login_url?>">
				<img src="../assets/images/twitter.png" style="height:5rem;">
			</a>
	    </div>
  	</div>
</body>
</html>