<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="css/submityoutube.css">
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
if(	(isset($_POST['game']) AND $_POST['game']!=NULL) AND 
	(isset($_POST['record']) AND $_POST['record']!=NULL) AND 
	(isset($_POST['type']) AND $_POST['type']!=NULL) AND
	(isset($_POST['source']) AND $_POST['source']!=NULL) AND
	(isset($_POST['description']) AND $_POST['description']!=NULL)
	){
	$req = $bdd->prepare('INSERT INTO records(record,type,idgame,source,description) VALUES(:record,:type,:idgame,:source,:description)');
	$req->execute(array(
			'record' => $_POST['record'],
			'type' => $_POST['type'],
			'idgame' => $_POST['game'],
			'source' => $_POST['source'],
			'description' => $_POST['description']
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
} else {
?>
		<form method="post" action="submit.php"> 
		<h1>Game:</h1>	
		<select class="round" id="game" name="game" onChange="updateType(this.selectedIndex);">
			<option value="" disabled selected style="display:none;"></option>
			<?php
				$reponse = $bdd->query('SELECT id,name FROM games ORDER BY id') or die(print_r($bdd->errorInfo()));
				while ($donnees = $reponse->fetch())
				{
			?>
			<option value="<?php echo $donnees['id'] ?>" 
			<?php if(isset($_POST['game'])){if ($_POST['game']==$donnees['id']){ echo 'selected="selected"';}}?>> 
				<?php echo $donnees['name'] ?>
			</option>
			<?php
			}
			?>
			<script>
				function updateType(id)
				{
					document.getElementById('base').style.display = "none";
					for (var i=1;i<=document.getElementById("game").options.length;i++)
					{ 
						if(i==id){
							document.getElementById('type_'+i).style.display = "block";
						}else{
						document.getElementById('type_'+i).style.display = "none";
						}
					}
				}
			</script>
		</select>
		<h1>record:</h1>
		<input class="round" type="text" id ="record" name="record" value="">
		<h1>Type:</hi>
		<input class="round" id="base" type="text" name="base" value="Choose a game first!" readonly>
		<?php
		$reponse = $bdd->query('SELECT id,types FROM games ORDER BY id') or die(print_r($bdd->errorInfo()));
		while($donnees = $reponse->fetch())
		{
		?>
		<select class="round" id="type_<?php echo $donnees['id'] ?>" name="type" style="display:none;">
			<option value="" disabled selected style="display:none;">Choose type!</option>
			<?php
				$array = explode(',',$donnees['types']);
				foreach ($array as $value)
				{
					?>
						<option value="<?php echo $value ?>" 
						<?php if(isset($_POST['type'])){if ($_POST['type']==$value){ echo 'selected="selected"';}}?>>
						<?php echo $value ?>
						</option>
					<?php
				}
			?>
		</select>
		<?php
			}
		?>
		<h1>Video:</h1>
		<p class="youtube">Only paste the code after the "watch?v=" like this : <br />
		http://www.youtube.com/watch?v=dQw4w9WgXcQ = "dQw4w9WgXcQ"
		</p>
		<input class="round" type="text" id="source" name="source">
		<h1>Description:</h1>
		<textarea rows="10" cols="50" class="round" name="description" id="description" ></textarea>
		<br />
		<img src="images/1.png" onload="autoFill()" width="0px" height="0px">
		<input class="round" type="submit" name="sumbit" value="break it!"/>
		<?php 
		if(isset($_POST['source'])){
			$source = $_POST['source'];
		}
		if(isset($_POST['record'])){
			$record = $_POST['record'];
		} 
		if(isset($_POST['description'])){
			$description = $_POST['description'];
		}
		if(isset($_POST['game'])){
			$game = $_POST['game'];
		}
		?>
			<script>
				function autoFill()
				{
					document.getElementById('record').value = <?php echo $record ?>;
					document.getElementById('source').value ="<?php echo $source ?>";
					document.getElementById('description').innerHTML ="<?php echo $description ?>";
					updateType(<?php echo $game ?>);
				}
			</script>
	</form>
		<?php
} 
?>
