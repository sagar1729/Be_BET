<?php 
require_once("includes/initialize.php"); 
?>


<?php include("header.php"); ?>
<div class="row">
  <!-- <div class="col-md-2" id="left_content">
     
	  <?php include("left_content.php"); ?> 
  </div> -->
  <div class="col-md-12" id="right_content">
   <!-- right content -->

 
<?php
 if(isset($_POST['submit']))
 {
    
   //  $database->query("INSERT INTO `bet`.`matches` (`id`, `teamA`, `teamB`) VALUES (NULL, 'CSK', 'RCB')");
	 
   echo "Created Successfully!!<br/><br/><br/>";
  //   $num=$_POST['number'];
   
     $matches = new matches();
     
	 
	 
	 $matches->id=NULL;
	 $matches->teamA=$_POST['teamA'];
	 $matches->teamB=$_POST['teamB'];
	 $matches->create(); 
	 
  }
?>



<div class="tabbable">
<div class="tab-content">
<div id="demo" class="tab-pane active">

<form action="" id="contact-form" class="form-horizontal" method="post">



  <div class="control-group">
 <label class="control-label" for="name">Team A</label>
 <div class="controls">
 <input type="text" class="input-xlarge" name="teamA" id="teamA">
 </div>
 </div>

 
  <div class="control-group">
 <label class="control-label" for="name">Team B</label>
 <div class="controls">
 <input type="text" class="input-xlarge" name="teamB" id="teamB">
 </div>
 </div>

 

<div class="">
<button type="submit" class="btn" name="submit">Create match</button>
</div>

</form>
</div><!-- .tab-pane -->
</div><!-- .tab-content -->
</div>
	
    <!--end of right content -->
   
  
  </div>
</div>
</div>
</body>
</html>
