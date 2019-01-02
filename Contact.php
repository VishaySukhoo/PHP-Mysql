<?php
session_start();
include_once 'dbconnect.php';
?>
<!DOCTYPE HTML>
<html>




<head>
   <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style>

.jumbotron {
    background-color:Gainsboro !important; 
     margin: auto;
    width: 20%;
 
    padding: 10px;

    
}

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
  
    <h1>Contacts</h1>
    
     <table class='table1' align=Center border="4" width="80%" height="20%">
       
      
         <tr>     
            <td rowspan="1" align=Center><a target="_blank"><img src="upload\Empty.jpg"></a></td>
                               
            <td rowspan="1" align=Center><h7>21404636 - Vishay Sukhoo</h7></td>
           </tr>  
        <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
        

</body>

</html>