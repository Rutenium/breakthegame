<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="css/submityoutube.css">
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
if((!isset($_POST['score'])) OR (!isset($_POST['source']))){
?>
	<form method="post" action="submityoutube.php"> 
		<h1>Game:</h1>
		<select class="round" name="game" required>
			<option value="" disabled selected style="display:none;">Choose your game!</option>
			<?php
				$reponse = $bdd->query('SELECT id,name FROM games') or die(print_r($bdd->errorInfo()));
				while ($donnees = $reponse->fetch())
				{
			?>
			<option value="<?php echo $donnees['id'] ?>"><?php echo $donnees['name'] ?></option>
			<?php
			}
			?>
		</select>
		<h1>Score:</h1>
		<input class="round" type="number" name="score" required>
		<h1>Video:</h1>
		<input class="round" type="url" name="source"required>
		<br />
		<input class="valider" type="submit" name="valider"/>
	</form>
<?php
} else {
	$req = $bdd->prepare('INSERT INTO records(score,idgame,source) VALUES(:score,:idgame,:source)');
	$req->execute(array(
			'score' => $_POST['score'],
			'idgame' => $_POST['game'],
			'source' => $_POST['source']
	));
?>
		<div class="redirect">
			<h1> Your submit was successfully sent to the front page, you will be redirected to the main page soon!</h1>
			<a href="index.php">Skip Waiting!</a>
		</div>
		<script type="text/javascript">
			setTimeout(function(){location.replace("index.php")},4000);
		</script>
		<?php
} 
?>
