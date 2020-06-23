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


	if($op=='getretweeters')
	{
		$opt = ['id'=>$_REQUEST['tweetid'],'stringify_ids'=>TRUE,'count'=>100];

		try{

			$rtrs = $tw->get('statuses/retweeters/ids',$opt);

			if(!isset($rtrs->ids)) throw new Exception("Wrong Tweet link/id");
			
		    $opt = ['user_id'=>implode(',',$rtrs->ids),'include_entities'=>FALSE];
		    $users = $tw->get('users/lookup',$opt);

		    $retweeters = [];

		    foreach($users as $user)
		    {
		        $retweeters[] = ['id'=>$user->id_str,'uname'=>$user->screen_name,'name'=>$user->name];
		    }
		    $data = ['status'=>1,'retweeters'=>$retweeters];

		}catch(Exception $e){
			$data = ['status'=>0,'msg'=>$e->getMessage()];
		}

		echo json_encode($data);

	}

	if($op=='getrelation')
	{
		$opt1 = ['source_screen_name'=>$_REQUEST['u1'],'target_screen_name'=>$_REQUEST['u2']];
		$opt2 = ['target_screen_name'=>$_REQUEST['u1'],'source_screen_name'=>$_REQUEST['u2']];

		try{

			$u1 = $tw->get('friendships/show',$opt1);
			$u2 = $tw->get('friendships/show',$opt2);

			if(!isset($u1->relationship))
			{
				$err = (strpos($u1->errors[0]->message,'source')!==FALSE)?'first username was wrong':'second username was wrong';
			}
			elseif(!isset($u2->relationship))
			{
				$err = $u2->errors[0]->message;
			}

			if(isset($err)) throw new Exception($err);

			$data = ['u1'=>$u1->relationship->source,'u2'=>$u2->relationship->source];
			
		    $data = ['status'=>1,'data'=>$data];

		}catch(Exception $e){
			$data = ['status'=>0,'msg'=>$e->getMessage()];
		}

		echo json_encode($data);

	}

	if($op=='convert')
	{
		$url = "https://cdn.syndication.twimg.com/widgets/followbutton/info.json?";

		foreach(json_decode($_REQUEST['query']) as $key=>$val)	//always single element
		{
			$url .= "$key=$val";
		}

		$content = json_decode(file_get_contents($url),true);

		if(sizeof($content)!=0)
		{
			$data = ['status'=>1,'user'=>$content[0]];
		}
		else{
			$data = ['status'=>0,'msg'=>'provided input did not gives any result.'];
		}

		echo json_encode($data);		
		
	}


	//https://developer.twitter.com/en/docs/accounts-and-users/follow-search-get-users/api-reference/get-friendships-show