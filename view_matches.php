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

 
 <div class="row">

 <div class="col-md-6" >
<?php
   
    
   $res2=$database->query("select count(*) from matches");
   $set2=$database->fetch_array($res2);
   $counta = $set2['count(*)'];
 
 
 
 
 if($counta!=0)
   {
 
   echo "<table>";
 	echo "<tr><th>Match ID </th><th>Team A</th><th>Team B</th></tr>"; 
   
	
  $res=$database->query("select * from matches");
   while($set=$database->fetch_array($res))
    {   
     echo "<tr><td>{$set['id']}</td> <td>{$set['teamA']}</td><td>{$set['teamB']}</td></tr>"; 
    }
  
  echo "</table>";	
   
   }
   else
   {
   echo "No records!";
   }
  
?>
</div>

<?php  if(isset($per_person_a) && isset($per_person_b)) { ?>
<div>
<a href="save_del.php?p1=<?php echo $per_person_a; ?>&&p2=<?php echo $per_person_b ?>"><button type="button" class="btn btn-danger">Save and Del records</button></a>
</div>
<?php } ?>
</div>
    <!--end of right content -->
   
  
  </div>
</div>
</div>
</body>
</html>
