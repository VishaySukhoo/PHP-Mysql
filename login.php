<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: index.php");
}

include_once 'Dbconnect.php';

//check if form is submitted
if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE email = '" . $email. "' and password = '" . md5($password) . "' OR email = '" . $email. "' and password = '" . $password . "'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['name'];
        header("Location: index.php");
    } else {
        $errormsg = "Incorrect Email or Password!!!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
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
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
         body{
       background-image: url("background.jpg");
      background-size: cover;
      background-repeat: no-repeat;
        font-family: Arail, sans-serif;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <title>PHP Login Script</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
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
    

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                <fieldset>
                    <legend>Login</legend>
                    
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="email" placeholder="Your Email" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Your Password" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        New User? <a href="Register.php">Sign Up Here</a>
        </div>
    </div>
</div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>