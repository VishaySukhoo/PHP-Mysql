<?php
session_start();
include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
  
  
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
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
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
    </script>
    <script>
function showRSS(str) {
  if (str.length==0) {
    document.getElementById("rssOutput").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("rssOutput").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getrss.php?q="+str,true);
  xmlhttp.send();
}
</script>
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
    


  <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search Ad..." />
        <div class="result"></div>
    </div>
    
       
    <div class="container">
             
                    <div class="page-header clearfix">
                        <h2 align="center">Recently Posted</h2>
                       
                    </div>
                     </div>
                   <div class="row">
                  
                  
                    <?php
                    // Include config file
                    require_once 'config.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM Ad ORDER BY reg_date DESC LIMIT 6";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                          
                                while($row = $result->fetch_array()){
                               
                           ?>         
                        <div class="col-md-4">
                      <?php
                      
                                 	 if($row['userPic']==NULL){
                                 	 
                                 	 ?>
                                 <a href='read.php?id=<?php echo $row['id']?>'> <img src="upload/Empty.png" class="img-rounded" width="250px" height="250px" /></a>
                                 	 <?php } else{ ?>
                                 	 <a href='read.php?id=<?php echo $row['id']?>'> <img src="upload/<?php echo $row["userPic"]; ?>" class="img-rounded" width="250px" height="250px" /></a>
                                 	  <?php }
                                       
                                        echo "<h2>".$row['CompName']."</h2>";?>
                                       <span class="glyphicon glyphicon-earphone"><?php echo $row["Telephone"]?></span></t> <span class="glyphicon glyphicon-envelope"><?php echo $row["Email"]?></span>
                                 	
                              
                                   </div>    
                               <?php }
                              
                            // Free result set
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    $mysqli->close();
                    ?>
                   
              
                
   </div>
   
    
  
    
    
    </br>
    <div class="jumbotron">
     <h2 class="display-3" align="center">Categories</h2>
    
     <span class="glyphicon glyphicon-cutlery"></span> <a href="byFood.php">Food And Beverage</a></br>
    <span class="glyphicon glyphicon-road"></span><a href="byTransport.php">Transportation</a></br>
     <span class="glyphicon glyphicon-wrench"></span><a href="byConst.php">Construction and Contractors</a></br>
     <span class="glyphicon glyphicon-floppy-disk"></span> <a href="byIT.php">IT and Telecommunications</a></br>
   
     <span class="glyphicon glyphicon-shopping-cart"></span><a href="byRetail.php">Retail and shopping</a></br>
     <span class="glyphicon glyphicon-picture"></span><a href="byAgriculture.php">Agriculture</a></br>
     <span class="glyphicon glyphicon-education"></span><a href="byEducation.php">Education and Training</a></br>
     <span class="glyphicon glyphicon-unchecked"></span><a href="byOther.php">Other</a></br>
   
	 </div>
     <h2 align="left">Keep up with the news</h2>
     <form>
<select onchange="showRSS(this.value)">
<option value="">Select your preffered network:</option>
<option value="Google">Google News</option>
<option value="NBC">NBC News</option>
</select>
</form>
<br>
<div id="rssOutput">News</div>
   
</body>
</html>