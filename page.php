<link rel="stylesheet" type="text/css" href="css/index.css">
<?php
	include("header.php");
if(isset($_GET['name']) AND isset($_GET['path'])){
?>
<div class="post">
	<h1 class="title">
		<?php echo $_GET['name'] ?>
	</h1>
	<a href="<?php echo $_GET['path'] ?>">
	<img class="centered" src="<?php echo $_GET['path'] ?>">
	</a>
	<div class="breakit">
		<a class ="breakit" href="submit.php">BREAK IT!</a>
	</div>
</div>
<?php
} else {
?>
<script type="text/javascript">
	location.replace("404.php");
</script>
<?php
}
?>
