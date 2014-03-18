<?php //session_start(); ?>
<link rel="stylesheet" type="text/css" href="css/index.css">
<?php
include("header.php");
include("login.php");
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=breakthegame', 'breakthegame', '12345');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
} 
?>
<div class="post">
	<h1 class="intro"> Welcome to Break The Game! A place currently in construction where you can submit record for every video game! for now, we are still working on the website, you can try and submit a record if you'd like!</h1>
	<div class="breakit">
		<a class ="breakit" href="submit.php">BREAK IT!</a>
	</div>
	<h1 class="intro"> Our games so far:</h1>
	<?php
		$reponse = $bdd->query('SELECT * FROM games ORDER BY name');
		while ($donnees = $reponse->fetch())
		{
	?>
	<a href="index.php?game=<?php echo $donnees['id'] ?>">
		<h1 class="intro"> <?php echo $donnees['name'] ?> </h1>
	</a>
	<?php 
	}
	?>
</div>
<?php
if(isset($_GET['game'])){
	$reponse = $bdd->prepare('SELECT record,idgame,source FROM records WHERE idgame=:idgame ORDER BY record DESC');
	$reponse->execute(array(
		'idgame' => $_GET['game']
	))   or die(print_r($bdd->errorInfo()));
}else{
	$reponse = $bdd->query('SELECT record,idgame,source FROM records ORDER BY record DESC') or die(print_r($bdd->errorInfo()));
}
while ($donnees = $reponse->fetch())
{
	$reponsetmp = $bdd->prepare('SELECT name FROM games WHERE id=:id');
	$reponsetmp->execute(array(
			'id' => $donnees['idgame']
	));
	$donneestmp = $reponsetmp->fetch()
?>
	<div class="post">
		<h1 class="title"><?php echo $donnees['record'] ?>!</h1>
		<h1 class="game">on:<?php echo $donneestmp['name'] ?> </h1>
			<iframe width="80%" height="60%" src="//www.youtube.com/embed/<?php echo $donnees['source'] ?>" frameborder="0" allowfullscreen></iframe>
		<div class="breakit">
			<a class ="breakit" href="submit.php">BREAK IT!</a>
		</div>
	</div>
<?php
}
?>