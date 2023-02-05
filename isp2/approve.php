<?php

 echo "entered";
	/* 
	 * We process the admin login form here
	 */

	// Start from getting the hader which contains some settings we need
	require_once 'includes/headx.php';


// 	// require the admins class which containes most functions applied to admins
 	require_once "includes/classes/admin-class.php";

 	$admins 	= new Admins($dbh);

 	echo "entered";
// 	// Let's process the form now
// 	// Starting by checking if the forme has been submitted
	if (!isset($_POST) || sizeof($_POST) == 0 )
	{
		echo "If the form is submitted, let's check if the fields are not empty";
		session::set('error', 'Submit the form first.');
		$commons->redirectTo('login.php');
	}
// //If the form is submitted, let's check if the fields are not empty
	if ($commons->isFieldEmpty($_POST['username']) || $commons->isFieldEmpty($_POST['password']) ) 
	{
		echo "If the form is submitted, let's check if the fields are not empty";
		session::set('error', 'All fields are required.');
		//$commons->redirectTo('login.php');

	}

// 	// Now let's check if the the username and password match a line in our table
	
	$user_name = htmlspecialchars( $_POST['username'], ENT_QUOTES, 'UTF-8' );
	$user_pwd = htmlspecialchars( $_POST['password'], ENT_QUOTES, 'UTF-8' );

     
	if (!$admins->loginAdmin($user_name, $user_pwd)) 
	{
		echo "If the form is submitted, let's check if the fields are not empty";
		session::set('error', 'Cannot connect you. Check your credentials.');
		$commons->redirectTo('login.php');

	}

	echo "final";
// 	// Otherwise we can set a session to the admin and send him to the dashboard
// 	// The session will hold only the username.
	session::set('admin_session', $user_name);
	$commons->redirectTo('index.php');
