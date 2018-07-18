<?php
session_start();

require_once('google-spreadsheets-api.php');
require_once('settings.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$sapi = new GoogleSpreadsheetsApi();
		
		// Get the access token 
		$data = $sapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		
		// Save the access token as a session variable
		$_SESSION['access_token'] = $data['access_token'];

		// Redirect to the page where user can create spreadsheet
		header('Location: home.php');
		exit();
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>ARC Assessment</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>

<?php

$login_url = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/drive.file') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

?>

<a id="logo" href="<?= $login_url ?>">Login with Google</a>

</body>
</html>