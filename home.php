<?php

require("scripts/dao.php");
session_start();

// User attributes
$userid = 0;
$user = "";

// Logged in variables
$admin_logged_in = false;
$editor_logged_in = false;
$poster_logged_in = false;
$editor_poster_logged_in = false;

$enabled_user = false;


// if a page variable exists, get it
$page = "";
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
}


/** Check session variables for admin or editor id numbers. Here are some rules: */
if (isset($_SESSION['auth_id'])) {
    
    // Get the auth_id from the session
    $userid = $_SESSION['auth_id'];
	
	if ($userid !== 0) {
		$user = getUserObject($userid);
        
		if ($user->type === "admin") {
			$admin_logged_in = true;
		}
        else if ($user->type === "editorposter") {
            $editor_poster_logged_in = true;
        }
		else if ($user->type === "editor") {
			$editor_logged_in = true;
		}
        else if ($user->type === "poster") {
            $poster_logged_in = true;
        }
        
        if ($user->status === "enabled") {
            $enabled_user = true;
        }
        
	}
	else { header("Location: login.php"); }
}
else { header("Location: login.php"); }



/*   At this point, it is determined who is logged in, and what type of user they are 
|
|      - If not logged in correctly, user is redirected to login.php, nothing under 
|        here will be executed
|      - If the user is not 'enabled' (in their user->status) they will not see any view
|        even if they entered correct credentials. The user is logged in, but $enabled_user
|        will be false below (the very first check), so no view will open. Instead a 
|        message that their account is currently disabled will appear for 15 seconds, 
|        then sign them out automatically.
|      
|      
|                                                                                     */
/*====================================================================================*/

if ($enabled_user) {
    
    if ($editor_logged_in) {
        $editor_whitelist = array("professor");
        
        if (in_array($page, $editor_whitelist)) {
            require('views/editor/home-editor-'. $page .'.php');
        }
        else {
            require('views/editor/home-editor-professor.php');
        }
    }

    else if ($editor_poster_logged_in) {
        require("home-editorposter.php");
    }

    else if ($poster_logged_in) {
        require("home-poster.php");
    }

    else if ($admin_logged_in) {
        $admin_whitelist = array("department", "user");
        
        if (in_array($page, $admin_whitelist)) {
            require('views/admin/home-admin-'. $page .'.php');
        }
        else {
            require('views/admin/home-admin-department.php');
        }
    }
}

else {
    echo "<h2>Account Inactive</h2>";
    echo "<p>Welcome back " . $user->nicename . ". Unfortunately, your user account is currently inactive. Please contact the system administrator to re-enable it. <a href='logout.php'>Logout</a></p>";
    echo "<p>You will be automatically signed out in 15 seconds.</p>";
    echo '<meta http-equiv="refresh" content="15; url=logout.php">';
}

