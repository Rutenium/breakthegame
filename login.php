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
			  if(this.attributes["name"].value=="1") {
					$(this).addClass("selected");
					$("#login").css({ display: "block" });
					$("#register").css({ display: "none" });
				} 
			  if(this.attributes["name"].value=="2") {
					$(this).addClass("selected");
					$("#login").css({ display: "none" });
					$("#register").css({ display: "block" });
				}
			  if(this.attributes["name"].value=="4") {
				location.replace("include/logout.php");
			  }
			});
		});
	</script>
<div class="login">
	<?php
	if(isset($_POST['formtype']) AND $_POST['formtype']=='login'){
		$req = $bdd->prepare('SELECT id,password FROM users WHERE username=:username');
		$req->execute(array(
			'username' => $_POST['username']
		));
		$donnees = $req->fetch();
		if(isset($donnees['id'])){
			if($donnees['password']==$_POST['password']){
				$_SESSION['iduser']=$donnees['id'];
				?>
				<script>
					parent.history.go(-1);
				</script>
				<?php
			}else{
			$l_error = "Wrong password";
			}
		}else{
			$l_error = "No such username";
		}
	}
	if(isset($_POST['formtype']) AND $_POST['formtype']=='register'){
		$requsr = $bdd->prepare('SELECT id FROM users WHERE username=:username');
		$requsr->execute(array(
			'username' => $_POST['username']
		));
		$donneesusr = $requsr->fetch();
		
		$reqemail = $bdd->prepare('SELECT id FROM users WHERE email=:email');
		$reqemail->execute(array(
			'email' => $_POST['email']
		));
		$donneesemail = $reqemail->fetch();
		
		if(isset($donneesusr['id'])){
			$r_error = "Username already in use!";
		} else if(isset($donneesemail['id'])){
			$r_error = "A user already uses this Email!";
		}else{
		$req = $bdd->prepare('INSERT INTO users(username,password,email) VALUES(:username,:password,:email)');
		$req->execute(array(
			'username' => $_POST['username'],
			'password' => $_POST['password'],
			'email' => $_POST['email']
		));
		$req = $bdd->prepare('SELECT id FROM users WHERE username=:username');
		$req->execute(array(
			'username' => $_POST['username']
		));
		$donnees = $req->fetch();
		$_SESSION['iduser']=$donnees['id'];
		?>
		<script>
			parent.history.go(-1);
		</script>
		<?php
		}
	}
	?>
	<?php if(isset($_SESSION['iduser'])){ ?>
	<div class="menu">
		<ul class="tabrow">
			<li name="3"><a class="profil" href="#">Profil<a></li>
			<li name="4">Logout</li>
		</ul>
	</div>
	<?php } else { ?>
	<div class="menu">
		<ul class="tabrow">
			<li name="1"<?php if(!(isset($r_error))) {echo 'class="selected"';} ?>>Login</li>
			<li name="2"<?php if(isset($r_error)) {echo 'class="selected"';}?>>Register</li>
		</ul>
	</div>
	<?php
	}
	if(isset($_SESSION['iduser'])){
	$req = $bdd->prepare('SELECT username FROM users WHERE id=:iduser');
	$req->execute(array(
		'iduser' => $_SESSION['iduser']
	));
	$donnees = $req->fetch();
	?>
	<div class="loged">
		<p class="login"><?php echo $donnees['username']; ?></p>
	</div>
	<?php
	}else
	{
	?>
	<form id="login" method="post" action="login.php" class="login" <?php if(isset($r_error)) echo 'style="display:none"';?>>
		<p><?php if(isset($l_error)) echo $l_error; ?></p>
		<input type="hidden" name="formtype" value="login" />
		<p class="login">Username:</p>
		<input type="text" id="username" name="username" required>
		<p class="login">Password:</p>
		<input type="password" id="password" name="password" required>
		<input class="submit" type="submit" name="sumbit" value="Log in"/>
	</form>
	<form id="register" method="post" action="login.php" class="login" <?php if(isset($r_error)) {echo 'style="display:block"';} else {echo 'style="display:none"';}?>">
		<p><?php if(isset($r_error)) echo $r_error; ?></p>
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