<?php
//session_start();
require('configuration.php');

function get_mime_type($file) { // Fonction permettant de verifier que le type de fichier soumis à l'upload n'est pas exécutable sur le serveur
	$mtype = false;
	if (function_exists('finfo_open')) {
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mtype = finfo_file($finfo, $file);
		finfo_close($finfo);
	} elseif (function_exists('mime_content_type')) {
		$mtype = mime_content_type($file);
	}
	return $mtype;
}

?>

<?php
//$uploaddir = "uploads/".$_GET['classe_eleve']."/".$_GET['nom_eleve']."_".$_GET['prenom_eleve']."/"; // Un dossier par eleve
$uploaddir = "uploads/".$_GET['id_professeur_selectionne']."/".$_GET['classe_eleve']."/"; // Tous les eleves d'une classe dans le même dossier
$file = $uploaddir .$_GET['nom_eleve']."_".$_GET['prenom_eleve']."_". basename($_FILES['uploadfile']['name']);
$urldossier = "http://".$_SERVER['SERVER_NAME']."/Plume/uploads/".$_GET['id_professeur_selectionne']."/";
$urlfichier = "http://".$_SERVER['SERVER_NAME'].'/Plume/'.$file;

if (get_mime_type(basename($_FILES['uploadfile']['name'])) != "text/x-php")
{
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
if($activation_notification === true)
{
	$to      = $_GET['email_prof'];
	$subject = 'Fichier envoyé par '.$_GET['prenom_eleve'].' '.$_GET['nom_eleve'].' ('.$_GET['classe_eleve'].')';
	$message = "Bonjour ".$_GET['civilite_prof']." ".$_GET['nom_prof']." : accédez à votre dossier ici : $urldossier ou accédez directement au fichier ici : $urlfichier";
	$headers = 'From: plume@'."http://".$_SERVER['SERVER_NAME']. "\r\n" .
	'Reply-To: plume@'."http://".$_SERVER['SERVER_NAME'] . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
}
	return true;
} else {
	return false;

}
}
?>
