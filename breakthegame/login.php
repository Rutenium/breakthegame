<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="css/login.css">
<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=breakthegame', 'breakthegame', '12345');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
<!-- THIS SCRIPT CHANGES THE CLASS OF A CLICKABLE ELEMENT -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>
		$(function() {
			$("li").click(function(e) {
			  e.preventDefault();
			  $("li").removeClass("selected");
			  $(this).addClass("selected");
			  if(this.attributes["name"].value=="1") {
					$("#login").css({ display: "block" });
					$("#register").css({ display: "none" });
				} else {
					$("#login").css({ display: "none" });
					$("#register").css({ display: "block" });
				}
			});
		});
	</script>
<div class="login">
	<?php
	if(isset($_POST['username'])){
		$_SESSION['iduser']=$_POST['username'];
		?>
		<script type="text/javascript">
			location.replace("index.php")
		</script>
		<?php
	}
	if(isset($_SESSION['iduser'])){
	?>
	<div class="loged">
		<p class="login"><?php echo $_SESSION['iduser'] ?></p>
		<a href="include/logout.php" ><button type="button">Log out</button></a>
	</div>
	<?php
	}else
	{
	?>
	<div class="menu">
		<ul class="tabrow">
			<li name="1"class="selected">Login</li>
			<li name="2">Register</li>
		</ul>
	</div>
	<form id="login" method="post" action="login.php" class="login" >
		<input type="hidden" name="formtype" value="login" />
		<p class="login">Username:</p>
		<input type="text" id="username" name="username" required>
		<p class="login">Password:</p>
		<input type="password" id="password" name="password" required>
		<input class="submit" type="submit" name="sumbit" value="Log in"/>
	</form>
	<form id="register" method="post" action="login.php" class="login" style="display:none;">
		<input type="hidden" name="formtype" value="register" />
		<p class="login">Username:</p>
		<input type="text" id="username" name="username" required>
		<p class="login">Password:</p>
		<input type="password" id="password" name="password" required>
		<p class="login">Email:</p>
		<input type="text" id="email" name="email" required>
		<input class="submit" type="submit" name="sumbit" value="Register"/>
	<?php } ?>
</div>