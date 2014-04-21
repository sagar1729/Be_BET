
<?php 
require_once("includes/initialize.php"); 
?>

	<?php
	/* SEA,AMR,AFR,EUR,MED,WEP */
	//Author is Awesome
	/* $database->query("delete from patients where region_code='AMR'"); */
	for($i=0;$i<5;$i++)
	{
	$database->query("insert into customer(id,cname,camt,team) values('','#charan',800,'a')"); 
	echo "Added Record: ".$i."<br/>";
	}
	
	?>
					
<!--end of right content -->
   

</body>
</html>
