<h4>User information</h4>


<?php
include('../../src/dbconnection.php');
?>

<table>
	<?php 
	
	include('../../models/user.php');
	
	//view(1);
	
foreach($user as $u){
		?>			        
        
    <tr>
        <td>Name :</td><td> <?php echo $u[2] ;  ?> </td> 
    </tr>
    <tr>
        <td>Email :</td><td> <?php echo $u[1]; ?> </td> 
    </tr>
<?php } ?>
</table>
<?php ?>