<?php

	function RandomStr($n)
	{ 
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    $str = '';
	    while($n--) $str .= $characters[rand(0,strlen($characters)-1)];
	    return $str; 
	}


	function GenrateId($db,$table,$column,$size)
	{
		$q = "SELECT $column FROM $table";
		$ids = $db->query($q)->fetchall(PDO::FETCH_COLUMN);

		do{
			$id = RandomStr($size);
		}
		while(in_array($id,$ids));

		return $id;
	}

	function savehistory($db,$id)
	{
		$q = "	UPDATE user_data_history udh
  				JOIN users u ON udh.id = u.twitter_id
				SET udh.followers=u.followers,udh.following=u.following,udh.blocking=u.blocking
				WHERE u.twitter_id='$id'
			";

		$db->query($q);

		$q = "SELECT followers as oflr,following as ofln,blocking as oblk FROM user_data_history WHERE id='$id'";

		return $db->query($q)->fetch(PDO::FETCH_ASSOC);

	}