<?php

/*
    This script is a controller login service, which can be posted to, and used to 
    authenticate a user, of the types 'editor' or 'admin'. Upon successful 
    authentication (using the dao.php script), a user will be redirected to home.php.
    An unsuccessful logon will redirect the user back to the login.php page
    where they will be able to try logging in again.
    
    The only way a user can terminate their session and logout (other than a session 
    timing out), would be to hit logout.php script, which destroys the current session 
    and redirects back to the index page.
*/

require_once('../dao/dao.php');
require_once('../models/model.php');

$controllerType = $_POST['controllerType'];
$userid = 0;

if ($controllerType === "userLogin") {
	$input_username = $_POST['username'];
	$input_password = sha1($_POST['password']);
	$userid = validateUser($input_username, $input_password);
}

if ($userid !== 0) {
    addUserTrack($userid, "LOGIN_SUCCESSFUL", "Successful login to {$_POST['username']}");
    header("Location: ../home.php");
}
else {
    addUserTrack(0, "LOGIN_UNSUCCESSFUL", "Unsuccessful login to {$_POST['username']}");
    header("Location: ../login.php?feedback=Login unsuccessful. Please try again.");
}

?>
