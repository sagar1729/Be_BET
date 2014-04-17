
<!DOCTYPE html>
<html lang="en">
<head>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen" />
<link href="style.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" media="screen" />		
<script src="bootstrap/js/bootstrap.min.js" ></script>

<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
<style type="text/css">
	.bs-example{
    	margin: 20px;
    }
	
	

</style>


<div class="container-fluid">
<div class="row" id="header">
 <div class="col-md-12" id="header_content">
     
	  
  <!-- Link or button to toggle dropdown -->
   
<div class="bs-example">
    <span id="log">Be BET</span>
    <ul class="nav nav-pills pull-right">
        <li class="active"><a href="index.php">Home</a></li>
		
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Customer <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="enter_customer.php">Customer Entry</a></li>
            </ul>
        </li>
        
               <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Matches <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="view_matches.php">View Matches</a></li>
				<li><a href="enter_match.php">Enter Matches</a></li>
            </ul>
        </li>

        
    </ul>
</div>


  </div>
</div>
<!--
<div class="row" >
 <div class="col-md-12" id="header_boundary"></div>
</div>
-->



