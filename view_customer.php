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

<style>
td,th
{
width:100px;
}
</style>
 <div class="col-md-6" >
<?php
 
  $res=$database->query("select sum(camt) from customer where team='a'");
  $set=$database->fetch_array($res);
  $teama_amount=$set['sum(camt)'];
 
   $res2=$database->query("select count(*) from customer where team='a'");
   $set2=$database->fetch_array($res2);
   $counta = $set2['count(*)'];
   
   
  $res=$database->query("select sum(camt) from customer where team='b'");
  $set=$database->fetch_array($res);
  $teamb_amount=$set['sum(camt)'];
  
  
   $res2=$database->query("select count(*) from customer where team='b'");
   $set2=$database->fetch_array($res2);
   $countb = $set2['count(*)'];
 
 
   echo "Team A";
   echo "<table>";
 //	echo "<tr><th>Name</th><th>Amount</th></tr>"; 
   
	
  $res=$database->query("select * from customer where team='a'");
   while($set=$database->fetch_array($res))
    {   
     echo "<tr><td>{$set['cname']}</td><td>:{$set['camt']}</td></tr>"; 
    }
  
  
  echo "<tr><td><br/><b>Total:</b></td><td><br/>{$teama_amount}</td></tr>";
  
  echo "</table>";	
  echo "<br/>";
  echo "<b>Per person:</b>".floor($teamb_amount/$counta);
   
   
  
?>
</div>

 <div class="col-md-6" >
<?php
 
 
  echo "Team B";
   echo "<table>";
	// echo "<tr><th>Name</th><th>Amount</th></tr>"; 
   $res=$database->query("select * from customer where team='b'");
   while($set=$database->fetch_array($res))
    {   
	echo "<tr><td>{$set['cname']}</td><td>:{$set['camt']}</td></tr>"; 
   }
  
    echo "<tr><td><b><br/>Total:</b></td><td><br/>{$teamb_amount}</td></tr>";
	
   echo "</table>";	
   echo "<br/>";
  echo "<b>Per person:</b>".floor($teama_amount/$countb);
    
?>
</div>


</div>
    <!--end of right content -->
   
  
  </div>
</div>
</div>
</body>
</html>
