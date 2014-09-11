<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/administrator.css">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrator Dashboard</title>
    </head>

    <body>
        
        <div id="alertBox">
		  <div id="alertBoxBody" class="alert" role="alert">This is an alert</div>
	    </div>
    
        <div class="container-fluid">
            
            <div class="btn-group pull-right" style="margin-top: 10px;">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span> &nbsp;<?php echo $user->username; ?> &nbsp;<span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Update Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <h3>Administrator Dashboard</h3>
            <nav class="nav-admin">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary navigation active" openview="department">Department Manager</button>
                  <button type="button" class="btn btn-primary navigation" openview="user">User Manager</button>
                </div>
            </nav>
            
            <div class="container-body">
                <div class="view" id="view-department">
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#addDepartmentModal"><span class="glyphicon glyphicon-plus-sign"></span> Add Department</button><br />
                        </div>
                        <div class="col-sm-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">All Departments</h3>
                                </div>
                                <div class="panel-body">
                                <?php 
                                    $departments = getAllDepartments();
                                    $departmentList = "<div class='list-group' id='list-department'>";
                                    $counter = 0;
                                    foreach($departments as $department) {
                                        $departmentList .= "<a class='list-group-item list-department-item' href='#' departmentid='" . $department->id . "'><h5 class='list-group-item-heading'><span class='label label-primary'>". $department->id ."</span> ". $department->name ."</h5></a>";
                                        $counter++;
                                    }
                                    $departmentList .= "</div>" . $counter . " Results";
                                    echo $departmentList;
                                ?>
                              </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="view" id="view-user">
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#addUserModal"><span class="glyphicon glyphicon-plus-sign"></span> Add User</button><br />
                        </div>
                        <div class="col-sm-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">All Users</h3>
                                </div>
                                <div class="panel-body">
                                <?php 
                                    $users = getAllUsers();
                                    $userList = "<div class='list-group' id='list-user'>";
                                    $counter = 0;
                                    foreach($users as $user) {
                                        $userList .= "<a class='list-group-item list-user-item' href='#' userid='" . $user->id . "'><h5 class='list-group-item-heading'><span class='label label-primary'>". $user->id ."</span> ". $user->nicename ."</h5></a>";
                                        $counter++;
                                    }
                                    $userList .= "</div>" . $counter . " Results";
                                    echo $userList;
                                ?>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        

        <!-- Add Department Modal -->
        <div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                <h4 class="modal-title" id="myModalLabel">Add Department</h4>
              </div>
              <div class="modal-body">
                <form role="form">
                  <div class="form-group">
                    <label for="adddepartment-name">Department Name</label>
                    <input type="text" class="form-control" id="adddepartment-name" placeholder="Enter name of department">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addDepartmentButton">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Edit Department Modal -->
        <div class="modal fade" id="editDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                <h4 class="modal-title" id="myModalLabel">Edit Department</h4>
              </div>
              <div class="modal-body">
                <form role="form">
                  <div class="form-group">
                    <label for="adddepartment-name">ID Number</label>
                    <input type="text" class="form-control" id="editdepartment-id" readonly>
                  </div>
                  <div class="form-group">
                    <label for="adddepartment-name">Department Name</label>
                    <input type="text" class="form-control" id="editdepartment-name" placeholder="Enter name of department">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal" id="deleteDepartmentButton">Delete</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="editDepartmentButton">Save changes</button>
              </div>
            </div>
          </div>
        </div>
		
		
		
		<!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                <h4 class="modal-title" id="myModalLabel">Add User</h4>
              </div>
              <div class="modal-body">
                <form role="form">
				  <div class="form-group">
                    <label for="adduser-username">Name</label>
                    <input type="text" class="form-control" id="adduser-nicename" placeholder="Enter full name of the user">
                  </div>
                  <div class="form-group">
                    <label for="adduser-username">Username</label>
                    <input type="text" class="form-control" id="adduser-username" placeholder="Enter username">
                  </div>
				  <div class="form-group">
                    <label for="adduser-username">Password</label>
                    <input type="text" class="form-control" id="adduser-password" placeholder="Enter password">
                  </div>
				  <div class="form-group">
                    <label for="adduser-username">Email</label>
                    <input type="text" class="form-control" id="adduser-email" placeholder="Enter user's email">
                  </div>
				  <div class="form-group">
                    <label for="adduser-username">Type</label>
                    <select class="form-control" id="adduser-username">
						<option value="editor">Editor</option>
						<option value="poster">Poster</option>
						<option value="editorposter">Editor and Poster</option>
						<option value="admin">Administrator</option>
					</select>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addUserButton">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        
        
    </body>
    
    <script type="text/javascript" src="js/administrator.js"></script>
    <script type="text/javascript" src="js/sitewide.js"></script>
    
</html>



