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

   
<!--  form -->

<div class="row">

 <div class="col-md-6" >
 <div class="tabbable">
<div class="tab-content">
<div id="demo" class="tab-pane active">

<form action="" id="contact-form" class="inline" method="post">
  <div class="control-group">
 <label class="control-label" for="name">Enter Match ID for current status</label>
 <div class="controls">
 <input type="text" class="input-xlarge" name="match_id" id="teamA" placeholder="<?php if(isset($_POST['submit'])) echo $_POST['match_id'];?>">
 </div>
 </div>
 
<div>
<button type="submit" class="btn" name="submit">Submit</button>
</div>

</form>
</div><!-- .tab-pane -->
</div><!-- .tab-content -->
</div>
	
 </div>
</div>

<!-- end form -->
<br/><br/><br/>

   <?php if(isset($_POST['submit']) && is_numeric($_POST['match_id']) ) 
   {  
   $match_id=$_POST['match_id'];
   echo "<hr/>"; 
   ?>
 <br/><br/>
 <div class="row">

<style>
td,th
{
width:100px;
}
</style>
 <div class="col-md-6" >
 
 
 
<?php
 
  $res=$database->query("select sum(camt) from customer where team='a' and match_id={$match_id}");
  $set=$database->fetch_array($res);
  $teama_amount=$set['sum(camt)'];
 
   $res2=$database->query("select count(*) from customer where team='a' and match_id={$match_id}");
   $set2=$database->fetch_array($res2);
   $counta = $set2['count(*)'];
   
   
  $res=$database->query("select sum(camt) from customer where team='b' and match_id={$match_id}");
  $set=$database->fetch_array($res);
  $teamb_amount=$set['sum(camt)'];
  
  
   $res2=$database->query("select count(*) from customer where team='b' and match_id={$match_id}");
   $set2=$database->fetch_array($res2);
   $countb = $set2['count(*)'];
 
 
   
   echo "<u>Team A</u><br/><br/>";
 
 if($counta!=0)
   {
 
   echo "<table>";
 //	echo "<tr><th>Name</th><th>Amount</th></tr>"; 
   
	
  $res=$database->query("select * from customer where team='a' and match_id={$match_id}");
   while($set=$database->fetch_array($res))
    {   
     echo "<tr><td>{$set['cname']}</td><td>:{$set['camt']}</td></tr>"; 
    }
  
  
  // echo "<tr><td><br/><b>Total:</b></td><td><br/>{$teama_amount}</td></tr>";
  
  echo "</table>";	
  echo "<br/>";
  $per_person_a = floor($teamb_amount/$counta);
  echo "<b>Per person:</b>".$per_person_a;
   
   }
   else
   {
   echo "No records!";
   }
  
?>
</div>

 <div class="col-md-6" >
<?php
 
 
  echo "<u>Team B</u><br/><br/>";
   
   
 if($countb!=0)
   {
 
   echo "<table>";
	// echo "<tr><th>Name</th><th>Amount</th></tr>"; 
   $res=$database->query("select * from customer where team='b'  and match_id={$match_id}");
   while($set=$database->fetch_array($res))
    {   
	echo "<tr><td>{$set['cname']}</td><td>:{$set['camt']}</td></tr>"; 
   }
  
   // echo " <tr><td><b><br/>Total:</b></td><td><br/>{$teamb_amount}</td></tr>";
	
   echo "</table>";	
   echo "<br/>";
  $per_person_b = floor($teama_amount/$countb);
  echo "<b>Per person:</b>".$per_person_b;
 
  }
  else
  {
  echo "No records!";	
  }
  
?>
</div>

<?php   /* if(isset($per_person_a) && isset($per_person_b)) { ?>
<div>
<a href="save_del.php?p1=<?php echo $per_person_a; ?>&&p2=<?php echo $per_person_b ?>"><button type="button" class="btn btn-danger">Save and Del records</button></a>
</div>
<?php }  */?>
</div>

<?php } ?>
<br/><br/><br/>

    <!--end of right content -->
   
  
  </div>
</div>
</div>
</body>
</html>
