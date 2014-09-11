<?php

function getAllDepartments() {
    $departments = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM department";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// Bind result to Book object and push each one on the end of $books array
    while ($department = $result->fetch_object('Department')) {
		array_push($departments, $department);
	}
	
	mysqli_stmt_close($stmt);
	return $departments;
}

function addDepartment($name) {
    $link = connect_db();
	$sql = "INSERT INTO  `department` (`name`) VALUES (?)";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('s', $link->real_escape_string($name));
	$stmt->execute();
	$id = $link->insert_id;
	mysqli_stmt_close($stmt);
	$link->close();
	
	return $id;
}

function getDepartment($id) {
	$theDepartment = null;
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM department WHERE id = ? LIMIT 1";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();

	// bind the result to $theBook for json encoding
	while ($department = $result->fetch_object('Department')) {
		$theDepartment = $department;
	}
	
	mysqli_stmt_close($stmt);
	return $theDepartment;
}

function updateDepartment($id, $name) {
	$link = connect_db();
	$sql = "UPDATE  `department` SET `name`=? WHERE id = ?";
	
	// Create prepared statement and bind parameters
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('si', $link->real_escape_string($name),$id);
	
    // Execute the query, get the last inserted id
    $stmt->execute();
	$rows = $link->affected_rows;
	mysqli_stmt_close($stmt);
	$link->close();
    $department = getDepartment($id);
	
	return $department;
}

function deleteDepartment($id) {
	$link = connect_db();
	$sql = "DELETE FROM `department` WHERE id = ?";
	
	// Create prepared statement and bind parameters
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i', $id);
    $stmt->execute();
	mysqli_stmt_close($stmt);
	$link->close();
    return $id;
}



function addUser($username, $password, $nicename, $email, $type) {
    $link = connect_db();
	$sql = "INSERT INTO  `user` (`username`, `password`, `nicename`, `email`, `type`) VALUES (?, ?, ?, ?, ?)";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('sssss', 
					  $link->real_escape_string($username),
					  $link->real_escape_string($password),
					  $link->real_escape_string($nicename),
					  $link->real_escape_string($email),
					  $link->real_escape_string($type));
	$stmt->execute();
	$id = $link->insert_id;
	mysqli_stmt_close($stmt);
	$link->close();
	
	return $id;
}

function getAllUsers() {
    $users = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM user";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// Bind result to Book object and push each one on the end of $books array
    while ($user = $result->fetch_object('User')) {
		array_push($users, $user);
	}
	
	mysqli_stmt_close($stmt);
	return $users;
}

function getUser($id) {
	$theUser = null;
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM user WHERE id = ? LIMIT 1";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();

	// bind the result to $theBook for json encoding
	while ($user = $result->fetch_object('User')) {
		$theUser = $user;
	}
	
	mysqli_stmt_close($stmt);
	return $theUser;
}

?>