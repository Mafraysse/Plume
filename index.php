<?php
// Il est nécessaire d'accorder tous les droits à ce fichier (777)
session_start();
require("configuration.php");
?>
<html>
<head>
<link href="styles.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Plume Uploader</title>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<script src="ajaxme/jquery.js"></script>

</head>

<body>
	<div id="main">
<div id="logo">Plume</div>
	<?php
    if (isset($_GET['prenom_eleve']) && !empty($_GET['prenom_eleve'])
&& isset($_GET['nom_eleve']) && !empty($_GET['nom_eleve'])
&& isset($_GET['classe_eleve']) && !empty($_GET['classe_eleve'])
&& isset($_GET['prof_select']) or !empty($_GET['prof_select'])) {
        $prenom_eleve = $_GET['prenom_eleve'];
        $nom_eleve = $_GET['nom_eleve'];
        $classe_eleve = $_GET['classe_eleve'];
        $id_professeur_selectionne = $_GET['prof_select'];
    //echo $id_professeur_selectionne;
    } else {
        ?>
		<h2>Transfert de fichier</h2>

		<!-- MENU DE SELECTION DU PROF -->
		<!-- Configurer la listes des personnes dans le fichier configuration.php -->
		<form action="index.php" method="get">
			<label for="nom_eleve">Ton nom :</label><br>
  <input required type="text" id="nom_eleve" name="nom_eleve" value=""><br>
  <label for="prenom_eleve">Ton prénom :</label><br>
  <input required type="text" id="prenom_eleve" name="prenom_eleve" value=""><br>
	<label for="classe_eleve">Ta classe :</label><br>
	<input  required type="text" id="classe_eleve" name="classe_eleve" value=""><br>

			<select style="margin-top:30px; height:30px" required id="prof_select" name="prof_select">  <!-- onChange="location=this.options[this.selectedIndex].value;"-->
			    <option value="" selected>Choisis la personne à laquelle tu souhaites envoyer un fichier</option>

			<?php
            foreach ($enseignants as $key => $value) {
                ?>
			     <option value="<?php echo $key; ?>"><?php echo $value['0']; ?> <?php echo $value['1']; ?></option>
			    <?php
            } ?>
			       </select>

					<p><input style="background-color: mediumseagreen; border:1px; font-size:25px;" type="submit" value="Je valide"></p>
		</form>
		<!-- FIN MENU DE SELECTION DU PROF -->
	<?php
include("footer.php");
    exit('');
    }

    // Création d'un répertoire pour le professeur via $id_professeur_selectionne si celui-ci ne fonctionne pas
    if (!is_dir("uploads/".$enseignants[$id_professeur_selectionne][3]."/") == true) {
        mkdir("uploads/".$enseignants[$id_professeur_selectionne][3]."/", 0745); // Création du dossier
        copy("uploads/index.php", "uploads/".$enseignants[$id_professeur_selectionne][3]."/index.php");
    }
    // Création d'un répertoire pour la classe si il n'existe pas
    if (!is_dir("uploads/".$enseignants[$id_professeur_selectionne][3]."/".$classe_eleve."/") == true) {
        mkdir("uploads/".$enseignants[$id_professeur_selectionne][3]."/".$classe_eleve."/", 0745); // Création du dossier
    }
    ?>

<h2>Transfert d'un fichier à <?php echo $enseignants[$id_professeur_selectionne][0]." ".$enseignants[$id_professeur_selectionne][1]; ?></h2>

<div id="upload" name="upload"><p align="center">Sélectionner le document à transmettre</p></div>
<div id="zonedenotification"></div>
<div style="text-align:center;">

<p style="padding:5px;
  border-collapse:collapse;
  border:1px solid black;  ">Formats autorisés :<br><?php echo str_replace('|', ' | ', $formats_autorises); ; ?></p>
	<p><?php echo 'Taille maximum autorisée : ' . ini_get('post_max_size') . "\n";?> </p>
</div>
</div>
<script type="text/javascript" >
var rep = '<?php echo "uploads/"; ?>' ;
var site  = '<?php echo $enseignants[$id_professeur_selectionne][3].'/'; ?>' ;
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-file.php?id_professeur_selectionne=<?php echo $enseignants[$id_professeur_selectionne][3];?>&civilite_prof=<?php echo $enseignants[$id_professeur_selectionne][0];?>&nom_prof=<?php echo $enseignants[$id_professeur_selectionne][1];?>&email_prof=<?php echo $enseignants[$id_professeur_selectionne][2];?>&classe_eleve=<?php echo $classe_eleve;?>&prenom_eleve=<?php echo $prenom_eleve;?>&nom_eleve=<?php echo $nom_eleve;?>',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(<?php echo $formats_autorises; ?>)$/.test(ext))){
					alert('Ce type de fichier choisi n\'est pas autorisé');
					return false;
				}

		$("#zonedenotification").show();
		document.getElementById("zonedenotification").innerHTML="<p class=\"encours jaune\"><img src=\"ajaxme/ajax-loader.gif\" alt=\"\"> Mise en ligne en cours, merci de patienter cela peut-être long...</p>";
			},
		onComplete: function(file, response){
		//On completion clear the status
		document.getElementById("zonedenotification").innerHTML="<p class=\"reussite vert\">Mise en ligne terminée</p>";
		//Add uploaded file to list
		//alert(response);
		document.getElementById("zonedenotification").innerHTML='<p class=\"reussite vert\">Le document '+file+' est en ligne <a target="_blank" href="<?php echo "uploads/".$enseignants[$id_professeur_selectionne][3]."/".$classe_eleve."/".$nom_eleve."_".$prenom_eleve."_"; ?>'+file+'">ici</a></p>';

	$("#zonedenotification").delay(30000).fadeOut(1600);
			}
		});
	});
</script>
<?php include("footer.php"); ?>
</body>
</html>
