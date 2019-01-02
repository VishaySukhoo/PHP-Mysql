<?php
session_start();
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once 'config.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM users WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                $email = $row["email"];
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
     <style>



/* mouse over link */
a:hover {
    color: green;
}

/* selected link */
a:active {
    color: blue;
}

</style>
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
         body{
     background-image: url("background.jpg");
      background-size: cover;
      background-repeat: no-repeat;
        font-family: Arail, sans-serif;
        }
    </style>
</head>
<body>
<div class="navbar navbar-inverse navbar-static-top">
              <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <a class="navbar-brand" href="index.php"><h4>E-Yellow Pages</h4></a>
     	</div>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                <li><a href="logout.php">Log Out</a></li>
                <?php if (isset($_SESSION['usr_id'])&& $_SESSION['usr_id']!=1) { ?>
                  <li><a href="create.php">ADD LISTING</a></li>
				  <li><a href="MyAds.php">My Ads</a></li> <?php } ?>
                 
                  <?php if ($_SESSION['usr_id']==1) { ?>
                   <li class="w3-dropdown-hover">
                            <a href="#">ADMIN<i class="fa fa-caret-down"></i></a>
                            <div class="w3-dropdown-content w3-white w3-card-4">
                                <a href="manage.php">ADS</a></br>
                                 <a href="manageusers.php">Users</a>
                                
                            </div>
                        </li>
                   <?php } ?>
                <?php } else { ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="Register.php">Sign Up</a></li>
                 <li><a href="create.php">ADD LISTING</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="row">
         <div class="container">
    <ul class="nav navbar-nav navbar-left">
  
  <li><a href="https://www.youtube.com/channel/UC493IMR_o654XhC88OQW1cQ" target="_blank">Video Channel</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>
</div>
</div>
    </div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Account</h1>
                    </div>
                     <div class="form-group">
                        <label>ID</label>
                        <p class="form-control-static"><?php echo $row["id"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                    </div>
                 

                    
                    <p><a href="manageusers.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>