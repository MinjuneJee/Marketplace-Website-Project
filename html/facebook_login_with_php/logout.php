<?php
// Include configuration file
error_reporting (E_ALL ^ E_NOTICE); // remove error "Notice: Undefined variable or undefined index"
require_once 'config.php';

// Remove access token from session
unset($_SESSION['facebook_access_token']);

// Remove user data from session
unset($_SESSION['userData']);

unset($_SESSION['oauth_uid']);
// Remove user data from session
unset($_SESSION['email']);
// Remove user data from session
unset($_SESSION['picture']);
// Remove user data from session
unset($_SESSION['first_name']);
// Remove user data from session
unset($_SESSION['last_name']);
// Remove user data from session
unset($_SESSION['logoutURL']);

unset($_SESSION['link']);

// Redirect to the homepage
header('Location: index.php');

?>
