<?php
	
	require '../auth/twitteroauth/autoload.php';
	require '../auth/conf.php';

	use TwitterOAuth\TwitterOAuth;

	session_start();
	header('Content-Type: text/json');

	if(!isset($_REQUEST['op']) || !isset($_SESSION[SESSION_NAME])) die(json_encode(['status'=>0,'msg'=>'login requred.']));

	$op = $_REQUEST['op'];
	
	$tw = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$_SESSION[SESSION_NAME]['token'],$_SESSION[SESSION_NAME]['secret']);

	$tw->setTimeouts(10,15);


	if($op=='fetchuser')
	{
		$opt = ['skip_status'=>true];

		try{
			$user = $tw->get('account/verify_credentials',$opt);
			$user = [
				'id'		=>	$user->id_str,
				'name'		=>	$user->name,
				'username'	=>	$user->screen_name,
				'followers'	=>	$user->followers_count,
				'followings'=>	$user->friends_count,
				'profile'	=>	$user->profile_image_url
			];
			$data = ['status'=>1,'user'=>$user];
		}catch(Exception $e) {
			$data = ['status'=>0,'msg'=>$e->getMessage()];
		}
			
	    echo json_encode($data);
	}

	if($op=='logout')
	{
		unset($_SESSION[SESSION_NAME]);
		setcookie(COOKIE_NAME,"",time()-COOKIE_EXPIRY_TIME,'/');	//delete cookie
		echo json_encode(['status'=>1,'msg'=>'Logout successfully']);
	}
		
	
	
