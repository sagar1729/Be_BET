

<?php 
require_once("includes/initialize.php"); 
?>


<?php include("header.php"); ?>
<div class="row">
  <div class="col-md-2" id="left_content">
     
	 <?php include("left_content.php"); ?>
  </div>
  <div class="col-md-10" id="right_content" >
   <!-- right content -->
	
<!-- individual Login START -->
     <br/><br/>
     
       <b>Individual Login:</b>
        <br/><br/>
        <div class="tabbable">
	<div class="tab-content">
	<div id="demo" class="tab-pane active"> 	
        <form action="./admin/index2.php" id="contact-form" class="form-horizontal" >





 <div class="control-group">
 <label class="control-label" for="name">Username</label>
 <div class="controls">
 <input type="text" class="input-xlarge" name="name" id="name"/>
 <input type="hidden" name="id" value="1111" />
 </div>
 </div>

 <div class="control-group">
 <label class="control-label" for="name">Password</label>
 <div class="controls">
 <input type="password" class="input-xlarge" name="pwd" id="pwd">
 </div>
 </div>



<div class="">
<button type="submit" class="btn">Submit</button>
<button type="reset" class="btn">Cancel</button>
</div>
</form>
<br/>
</div><!-- .tab-pane -->
</div><!-- .tab-content -->
</div>
				
<!-- individual Login END -->
<b>OR</b>
<!-- Center Login START -->
     <br/><br/>
     
       <b>Center Login:</b>
        <br/><br/>
        <div class="tabbable">
	<div class="tab-content">
	<div id="demo" class="tab-pane active"> 	
        <form action="./admin/index.php" id="contact-form" class="form-horizontal" >





 <div class="control-group">
 <label class="control-label" for="name">Center ID</label>
 <div class="controls">
 <input type="text" class="input-xlarge" name="name" id="name">
 </div>
 </div>

 <div class="control-group">
 <label class="control-label" for="name">Password</label>
 <div class="controls">
 <input type="password" class="input-xlarge" name="pwd" id="pwd">
 </div>
 </div>



<div class="">
<button type="submit" class="btn">Submit</button>
<button type="reset" class="btn">Cancel</button>
</div>
</form>
<br/><br/><br/><br/><br/>
</div><!-- .tab-pane -->
</div><!-- .tab-content -->
</div>
				
<!-- Center Login END -->
<!--end of right content -->
   
  
</div>
</div>
</div>

</body>
</html>
