<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="css/index.css">
<?php
include("header.php");
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
	<h1 class="intro"> Welcome to Break The Game! A place currently in construction where you can submit record for every video game! for now, we are working only with pictures, you can try and sumbit one if you'd like!</h1>
	<div class="breakit">
		<a class ="breakit" href="submit.php">BREAK IT!</a>
	</div>
</div>
<?php
$reponse = $bdd->query('SELECT titre,filename FROM images') or die(print_r($bdd->errorInfo()));
while ($donnees = $reponse->fetch())
{
?>
	<div class="post">
		<a class="breakit" href="page.php?name=<?php echo $donnees['titre'] ?>&path=<?php echo $donnees['filename'] ?>">
		<h1 class="title"><?php echo $donnees['titre'] ?></h1>
		<img class ="centered" src="<?php echo $donnees['filename'] ?>">
		</a>
		<div class="breakit">
			<a class ="breakit" href="submit.php">BREAK IT!</a>
		</div>
	</div>
<?php
}
?>