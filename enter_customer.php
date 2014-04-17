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
   echo "Entered Successfully!!<br/><br/><br/>";
  //   $num=$_POST['number'];
   
     $customer = new customer();
     
	 $customer->id='';
     $customer->cname = $_POST['name'];
     $customer->camt=$_POST['amount'];
	 $customer->team=$_POST['team'];
	 $customer->match_id=$_POST['match_id'];
	 $customer->create(); 
	 
   
  }
?>



<div class="tabbable">
<div class="tab-content">
<div id="demo" class="tab-pane active">

<form action="" id="contact-form" class="form-horizontal" method="post">


 <div class="control-group">
 <label class="control-label" for="name">Name</label>
 <div class="controls">
 <input type="text" class="input-xlarge" name="name" id="name">
 </div>
 </div>

  <div class="control-group">
 <label class="control-label" for="name">Amount</label>
 <div class="controls">
 <input type="text" class="input-xlarge" name="amount" id="amount">
 </div>
 </div>
 
 <div class="control-group">
 <label class="control-label" for="name">Match ID</label>
 <div class="controls">
 <input type="text" class="input-xlarge" name="match_id" id="team">
 </div>
 </div>

  <div class="control-group">
 <label class="control-label" for="name">Team ('a' or 'b')</label>
 <div class="controls">
 <input type="text" class="input-xlarge" name="team" id="team">
 </div>
 </div>

  


<div class="">
<button type="submit" class="btn" name="submit">Submit</button>
<button type="reset" class="btn">Cancel</button>
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
