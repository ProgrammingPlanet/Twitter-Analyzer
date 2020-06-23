<?php
	
	require '../auth/twitteroauth/autoload.php';
	require '../auth/conf.php';
	require '../dbcon.php';
	require '../utilities.php';

	use TwitterOAuth\TwitterOAuth;

	session_start();
	header('Content-Type: text/json');

	if(!isset($_REQUEST['op']) || !isset($_SESSION[SESSION_NAME])) 
		die(json_encode(['status'=>0,'msg'=>'login requred.']));

	$op = $_REQUEST['op'];

	$scrap_periode = DATA_SCRAPING_PERIOD;


	$tw = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$_SESSION[SESSION_NAME]['token'],$_SESSION[SESSION_NAME]['secret']);

	$tw->setTimeouts(10,15);

	$id = $_SESSION[SESSION_NAME]['id'];


	
	if($op=='fetchpeoples')
	{

		$lsc = $db->query("SELECT last_scraped FROM users WHERE twitter_id='$id'")->fetch(PDO::FETCH_COLUMN);

		if($lsc + $scrap_periode > time())	//serve local data
		{
			$q = "	SELECT u.followers,u.following,u.blocking,uh.followers as oflr,uh.following as ofln, uh.blocking as oblk
					FROM users as u
					JOIN user_data_history as uh
					ON u.twitter_id=uh.id
					WHERE u.twitter_id='$id'
				";

			$data = $db->query($q)->fetch(PDO::FETCH_ASSOC);

			$data = [
					'followers'		=>	json_decode($data['followers'],true),
					'followings'	=>	json_decode($data['following'],true),
					'blocking'		=>	json_decode($data['blocking'],true),
					'oflr'			=>	json_decode($data['oflr'],true),
					//'ofln'			=>	json_decode($data['ofln'],true),
					//'oblk'			=>	json_decode($data['oblk'],true)
					'last_scraped'	=>	date("h:m d-m-Y",$lsc),
					'next_scrap'	=>	date("h:m d-m-Y",$lsc+$scrap_periode)
			];

			$data = ['status'=>1,'data'=>$data];
		}
		else 	//serve new data
		{
			$opt = ['stringify_ids'=>1,'count'=>5000];

			try{
				$data = [
					'followers'=>$tw->get('followers/ids',$opt)->ids,//followers_ids
					'following'=>$tw->get('friends/ids',$opt)->ids, //following_ids
					'blocking'=>$tw->get('blocks/ids',$opt)->ids //blocking_ids
				];

				$od = savehistory($db,$id); // save old data to a table
				$lsc = time();

				$fr = json_encode($data['followers']);
				$fn = json_encode($data['following']);
				$b = json_encode($data['blocking']);

				$q = "UPDATE users SET followers='$fr', following='$fn', blocking='$b', last_scraped='".time()."' WHERE twitter_id='$id'";
				$db->query($q);

				$data = array_merge($data,[
						'oflr'	=>	json_decode($od['oflr'],true),
						// 'ofln'	=>	json_decode($od['ofln'],true),
						// 'oblk'	=>	json_decode($od['oblk'],true),
						'last_scraped'	=>	date("h:m d-m-Y",$lsc),
						'next_scrap'	=>	date("h:m d-m-Y",$lsc+$scrap_periode)
					]);
				
				$data = ['status'=>1,'data'=>$data];
				
			}catch(Exception $e) {
				$data = ['status'=>0,'msg'=>$e->getMessage(),'trace'=>$e->getTraceAsString()];
			}
		}

	    echo json_encode($data);
	}


	if($op=='fetchusers')
	{
		$user_ids = implode(',',$_REQUEST['userids']);

		$opt = ['include_entities'=>false,'user_id'=>$user_ids];

		try{
			$data = $tw->get('users/lookup',$opt);
			$users = [];
			foreach ($data as $key=>$user)
			{
				$users[] = [
					'id' => $user->id_str,
					'name' => $user->name,
					'username' => $user->screen_name,
					'verified' => $user->verified,
					'followers_count' => $user->followers_count,
					'following' => $user->following,
					'dp_url' => $user->profile_image_url
				];
			}
			$data = ['status'=>1,'users'=>$users];
		}catch(Exception $e) {
			$data = ['status'=>0,'msg'=>$e->getMessage()];
		}
			
	    echo json_encode($data);
	}

	if($op=='togglefollow')
	{
		$opt = ['user_id'=>$_REQUEST['userid']];

		try{
			$req = $_REQUEST['isfollowing']=='true' ? 'destroy':'create';

			$user = $tw->post("friendships/$req",$opt);

			if(isset($user->id))
			{
				$data = ['status'=>1,'msg'=>'success'];
			}
			else{
				$data = ['status'=>0,'msg'=>'Error Occured, try again.'];
			}
			
		}catch(Exception $e) {
			$data = ['status'=>0,'msg'=>$e->getMessage()];
		}
			
	    echo json_encode($data);
	}
	
	
