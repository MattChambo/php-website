<?php

// Must be first thing on index file
session_start();

// Make everything in the vendor folder available to use
require 'vendor/autoload.php';
require 'app/controllers/PageController.php';

// Load appropriate page

// Has the user requested a page?
// if( isset( $_GET['page']) ) {
// 	// Requested page
// 	$page = $_GET['page'];

// } else {
// 	// Home page
// 	$page = 'landing';
// }

$page = isset($_GET['page']) ? $_GET['page'] : 'landing';

// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'pinterest');

// Load the appropriate files based on the page
switch($page) {

	// Home page
	case 'landing':
	case 'register':
		require 'app/controllers/LandingController.php';
		$controller = new LandingController($dbc);
	break;

	// About page
	case 'about':
		echo $plates->render('about');
	break;

	// Contact page
	case 'contact':
		echo $plates->render('contact');
	break;

	// login page
	case 'login':
		require 'app/controllers/LoginController.php';
		$controller = new LoginController($dbc);
	break;

	// Stream page
	case 'stream':
		require 'app/controllers/StreamController.php';
		$controller = new StreamController($dbc);
	break;

	// Account page
	case 'account':
		require 'app/controllers/AccountController.php';
		$controller = new AccountController($dbc);
	break;

	case 'post':
		require 'app/controllers/PostController.php';
		$controller = new PostController($dbc);
	break;

	case 'edit-comment':
		require 'app/controllers/EditCommentController.php';
		$controller = new EditCommentController($dbc);
	break;


	case 'edit-post':
		require 'app/controllers/EditPostController.php';
		$controller = new EditPostController($dbc);
	break;

	case 'search':
		require 'app/controllers/SearchController.php';
		$controller = new SearchController($dbc);
	break;

	case 'logout':
		unset($_SESSION['id']);
		unset($_SESSION['privilege']);
		header('Location: index.php');
		
	break;

	default:
		echo $plates->render('error404');
	break;

}

$controller->buildHTML();

