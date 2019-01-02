<?php
session_start();
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$booCat = 0;
$strCat = "";
$name = $address = $desc = $email = $tel = $mobile = "";
$name_err = $address_err = $desc_err = $email_err = $tel_err = $mobile_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  if($_POST["Category"] == "Select...")
        $booCat = 1;
    else
    	$strCat = $_POST["Category"];
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    }  else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = 'Please enter an address.';     
    } else{
        $address = $input_address;
    }
     // Validate description
    $input_desc = trim($_POST["description"]);
    if(empty($input_desc)){
        $desc_err = 'Please enter a description.';     
    } else{
        $desc = $input_desc;
    }
      // Validate email
    $input_email = trim($_POST["email"]);
    if(!filter_var($input_email,FILTER_VALIDATE_EMAIL)) {
        $email_err = 'Please enter an email address.';     
    } else{
        $email = $input_email;
    }
      // Validate Telephone
    $input_tel = trim($_POST["tel"]);
   if(strlen($input_tel) !=10) {
        $tel_err = 'Please enter a telephone number';     
    } else{
        $tel = $input_tel;
    }
      // Validate Mobile
    $input_mobile = trim($_POST["mobile"]);
    if(strlen($input_mobile) !=10) {
        $mobile_err = 'Please enter a mobile number.';     
    } else{
        $mobile = $input_mobile;
    }
      if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
      
        // Verify file extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    	$userpic = rand(1000,1000000).".".$ext;
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("upload/" . $_FILES["photo"]["name"])){
                echo $_FILES["photo"]["name"] . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" .$userpic);
                echo "Your file was uploaded successfully.";
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }

    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($desc_err) && empty($email_err) && empty($tel_err) && empty($mobile_err) && !($booCat)){
        // Prepare an insert statement
        $sql = "INSERT INTO Ad(CompName,Address,CompDesc,Email,Telephone,Mobile,Category,userPic,userid,reg_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, '{$_SESSION['usr_id']}' ,NOW())";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
          $stmt->bind_param("ssssssss", $param_name, $param_address, $param_desc, $param_email, $param_tel, $param_mobile,$param_cat,$param_userpic);
			//corresponding variable type string-s double- d
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_desc = $desc;
            $param_email = $email;
            $param_tel = $tel;
            $param_mobile = $mobile;
            $param_cat=$strCat;
           
            $param_userpic = $userpic;
           
           // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: manage.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
     <script>
        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            var options = {

                componentRestrictions: { country: "za" }
            };

            autocomplete = new google.maps.places.Autocomplete(
             (document.getElementById('address')),
               options);

            google.maps.event.addDomListener(window, 'load', initAutocomplete); {
                //new google.maps.places.SearchBox(document.getElementById('travelfrom'));
                //new google.maps.places.SearchBox(document.getElementById('travelto'));
                directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true });
            };

        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyCQtbps2ACnwtkwGvL1JSGLBEMgRpCHNDQ&libraries=places&callback=initAutocomplete"
            async defer></script>
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
<?php
if(isset($_SESSION['usr_id'])=="") {
	echo "You need to be logged in to post an ad";?>
    <a href="login.php">Login</a>
<?php } 
else{ ?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form. </p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" id="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($desc_err)) ? 'has-error' : ''; ?>">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" value="<?php echo $desc; ?>">
                            <span class="help-block"><?php echo $desc_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($tel_err)) ? 'has-error' : ''; ?>">
                            <label>Telephone Number</label>
                            <input type="text" name="tel" class="form-control" value="<?php echo $tel; ?>">
                            <span class="help-block"><?php echo $tel_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile" class="form-control" value="<?php echo $mobile; ?>">
                            <span class="help-block"><?php echo $mobile_err;?></span>
                        </div>
                        <select name='Category' id='Category'>
	<option>Select...</option>
	<option>Food and Beverage</option>
	<option>Transportation</option>
		<option>Construction and Contractors</option>
	<option>IT and Telecommunications</option>
	<option>Retail and shopping</option>
	<option>Agriculture</option>
	<option>Education and Training</option>
		<option>Other</option></select>
	
<?php if($booCat) echo "Please select a Category!" ?>
                                <label for="fileSelect">Filename:</label>

        <input type="file" name="photo" id="fileSelect"/>
        <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        
                        <a href="manage.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    <?php } ?>
</body>
</html>