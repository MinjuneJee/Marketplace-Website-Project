<?php
// Include configuration file
error_reporting (E_ALL ^ E_NOTICE); // remove error "Notice: Undefined variable or undefined index"

require_once 'config.php';

// Include User class
require_once 'User.class.php';

if(isset($accessToken)){
	if(isset($_SESSION['facebook_access_token'])){
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}else{
		// Put short-lived access token in session
		$_SESSION['facebook_access_token'] = (string) $accessToken;

	  	// OAuth 2.0 client handler helps to manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		// Set default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}

	// Redirect the user back to the same page if url has "code" parameter in query string
	if(isset($_GET['code'])){
		header('Location: /index.php');
	}

	// Getting user's profile info from Facebook
	try {
		$graphResponse = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,picture');
		$fbUser = $graphResponse->getGraphUser();
	} catch(FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// Redirect user back to app login page
		header("Location: /index.php");
		exit;
	} catch(FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	// Initialize User class
	$user = new User();

	// Getting user's profile data
    $fbUserData = array();
    $fbUserData['oauth_uid']  = !empty($fbUser['id'])?$fbUser['id']:'';
    $fbUserData['first_name'] = !empty($fbUser['first_name'])?$fbUser['first_name']:'';
    $fbUserData['last_name']  = !empty($fbUser['last_name'])?$fbUser['last_name']:'';
    $fbUserData['email']      = !empty($fbUser['email'])?$fbUser['email']:'';
    $fbUserData['gender']     = !empty($fbUser['gender'])?$fbUser['gender']:'';
    $fbUserData['picture']    = !empty($fbUser['picture']['url'])?$fbUser['picture']['url']:'';
    $fbUserData['link']       = !empty($fbUser['link'])?$fbUser['link']:'';



    // Insert or update user data to the database
    $fbUserData['oauth_provider'] = 'facebook';
    $userData = $user->checkUser($fbUserData);

    // Storing user data in the session
    $_SESSION['userData'] = $userData;

	// Get logout url
	$logoutURL = $helper->getLogoutUrl($accessToken, 'https://www.mjworld-music.com/facebook_login_with_php/logout.php');
		// $logoutURL = $helper->getLogoutUrl($accessToken, 'http://localhost:8080/facebook_login_with_php/'logout.php');

	// Render Facebook profile data
	if(!empty($userData)){
					// $output = '<h2>Welcome to MJworld-Music</h2>';
					// $output  = '<h2>Facebook Profile Details</h2>';
					// $output .= '<div class="ac-data">';
					// $output .= '<img src="'.$userData['picture'].'"/>';
			    // $output .= '<p><b>Facebook ID:</b> '.$userData['oauth_uid'].'</p>';
			    // $output .= '<p><b>Name:</b> '.$userData['first_name'].' '.$userData['last_name'].'</p>';
			    // $output .= '<p><b>Email:</b> '.$userData['email'].'</p>';
			    // $output .= '<p><b>Gender:</b> '.$userData['gender'].'</p>';
			    // $output .= '<p><b>Logged in with:</b> Facebook'.'</p>';
					// $output .= '<p><b>Profile Link:</b> <a href="'.$userData['link'].'" target="_blank">Click to visit Facebook page</a></p>';
			    // $output .= '<p><b>Logout from <a href="'.$logoutURL.'">Facebook</a></p>';
					// $output .= '</div>';

		$_SESSION['email'] = $userData['email'];
		$_SESSION['picture'] = $userData['picture'];

		$_SESSION['first_name'] = $userData['first_name'];
		$_SESSION['last_name'] = $userData['last_name'];
		$_SESSION['oauth_uid'] = $userData['oauth_uid'];

		$_SESSION['link'] = $userData['link'];


		$_SESSION['logoutURL'] = $logoutURL;
	}else{
		$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}
}else{
	// Get login url
	$permissions = ['email']; // Optional permissions
	$loginURL = $helper->getLoginUrl(FB_REDIRECT_URL, $permissions);

	// Render Facebook login button
	$output = '<a href="'.htmlspecialchars($loginURL).'"><img src="images/fb-login-btn.png"></a>';
}
?>
<?php include '../php/before-main.php' ?>



<div class="container">
	<div class="policy"
			 style="width: 400px;
			 				height: 600px;
						  overflow: scroll;

							">

			<?php			include 'policy.php' ?>

	</div>

	<button id="agree" onclick="login_show()">Agree</button>

		<div id="facebook_login_show" style="display:none;">

					<div class="fb-box" >
						<!-- Display login button / Facebook profile information -->
						<?php echo $output; ?>
					</div>

		</div>

	<script>
function login_show() {
  var x = document.getElementById("facebook_login_show");
		var y = document.getElementById("agree");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }

	if (y.innerHTML == "Agree"){
		y.innerHTML = "Disagree";
		x.style.display = "inline-block"
	}else if(y.innerHTML == "Disagree"){
		y.innerHTML = "Agree";
		x.style.display = "none"
	}
}
</script>
<?php include '../php/after-main.php' ?>
