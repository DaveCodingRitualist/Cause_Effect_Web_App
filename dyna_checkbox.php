<?php
$educationArr=array('Clean the matt','Read end over','set up stations');
$arr=array();
if(isset($_POST['submit'])){
	$arr=$_POST['education'];
	 foreach($educationArr as $list){
	echo implode(", "."<br/><br/>",$arr);
	echo "<br/><br/>";
 } 
}
?>
<form method="post">
	<?php foreach($educationArr as $list){?>
	
		<?php if(in_array($list,$arr)){
			?><?php echo $list?> <input type="checkbox" name="education[]" value="<?php echo $list?>"/><br/><?php
		}else{
			?><?php echo $list?> 
			                     <input type="checkbox" name="education[]" value="<?php echo "Done"?>"/>
			
			<br/>
			<?php
		}
		?>
	<?php } ?>
	<br/><br/>
	<input type="submit" name="submit"/>
</form>