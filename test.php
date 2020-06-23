<?php

	header('Content-Type: text/json');

	session_start();

	require 'dbcon.php';
	require 'utilities.php';

	// print_r($_SESSION);
	// print_r($_COOKIE);

	// session_destroy();

	/*$q = "SELECT cookie FROM users WHERE twitter_id='3118401337'";

    $cv = $db->query($q)->fetch(PDO::FETCH_COLUMN);

    if($cv) print_r($cv);

    else print_r("not found");*/

    $id = '3118401337';

    $x = savehistory($db,$id);

    /*$id = '3118401337';

    $q = "	SELECT u.followers,u.following,u.blocking,uh.followers as oflr,uh.following as ofln, u.blocking as oblk
					FROM users as u
					JOIN user_data_history as uh
					ON u.twitter_id=uh.id
					WHERE u.twitter_id='$id'
				";

	$x = $db->query($q)->fetch(2);*/

	print_r($x);