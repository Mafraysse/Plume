<?php if(count(get_included_files()) ==1) exit("Direct access not permitted."); // Sécurité ?><?php
// Le fichier index.php doit avoir tous les droits (744)
// Le répertoire uploads doit être en (777)
// Pensez à paramétrer php pour que augmenter la taille des fichiers transférés


// Tableau de configuration des différents enseignants
// Quatre valeurs sont requises :
// Civilité, Nom de l'enseignant, Adresse email, Clé secrête

// La clé secrète unique permettra de créer un répertoire unique pour chaque enseignant. Cette clé ne doit pas fuiter sans quoi les fichiers mis en ligne par les élèves seront acessibles
$enseignants = array
(
  array("Mme", "Nom", "email@gmail.com", "ziudhzidqisdquisdh"),// Dupliquer cette ligne pour ajouter autant de comptes que nécessaires
  array("M.", "Fraysse", "email2@gmail.com", "zeiuzhfizufhaa")// Pas de virgule pour la dernière ligne
);
// Extensions de fichiers autorisés à l'upload
$formats_autorises = "jpg|png|jpeg|gif|mp3|pdf|doc|docx|xlsx|xls|numbers|pages|key|keynote|txt|odt"; // Attention : ne pas autoriser les fichiers executables : php ou autres.
$activation_notification = false; // true pour autoriser l'envoi d'un mail de notification
?>
