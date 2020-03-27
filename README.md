# Plume
Plume est un outil permettant aux élèves de transférer facilement des fichiers à leurs enseignants via un serveur.
Une fois mis en ligne sur un serveur, Plume créé de façon autonome les répertoires nécessaires à son fonctionnement.
# Droits
⚠️ Le répertoire de Plume doit avoir l'autorisation d'écriture et d'exécution :
- Le fichier index.php doit avoir tous les droits (777) ;
- Le répertoire uploads doit être en (777) ;
# Installation
##Configuration du script
Ouvrir le fichier "configuration.php" pour modifier les variables nécessaires.
`$enseignants : contient les informations relatives aux enseignants sous la forme d'un tableau. Un enseignant par ligne.`
- Civilité ;
- Nom de l'enseignant ;
- Adresse email de l'enseignant ;
- **Clé secrète**, qui sera utilisée pour créer un répertoire. Il n'est pas nécessaire de donner cette clé à l'enseignant si les notifications par email sont activées. La clé secrète fait partie de l'URL transmise dans les notifications. Cette clé peut être changé à tout moment dans le fichier "configuration.php" si elle est compromise. Il faudra alors renommer le répertoire de l'enseignant dans le dossier "uploads" afin que l'accès à ses données soit toujours possible.

`$formats_autorises : contient les formats de fichier qui sont autorisés.`
**⚠️Ne pas autoriser la mise en ligne de fichier contenant du code exécutable !**

`$activation_notification : doit contenir "oui" pour activer les notifications par mail de l'enseignant en cas de mise en ligne d'un nouveau fichier dans son répertoire.`
# Personnalisation de l'explorateur de fichier :
Plume copie le fichier "index.php" qui se trouve à la racine du dossier "uploads" dans chaque dossier d'enseignant lors de la mise ne ligne du premier document. Ce fichier "index.php" sert donc de model. Les variables suivantes peuvent être personnalisées.
`$allow_delete = true; // Autorise la suppression des données ;`

`$allow_upload = false; // Autorise la mise en ligne de fichiers par l'enseignant ;`

`$allow_create_folder = false; // Autorise la création de dossiers par l'enseignant dans son dossier ;`

`$allow_direct_link = true; // Permet de télécharger directement les fichiers via l'url ;`

`$allow_show_folders = true; // Cacher les sous-dossiers ;`

`$PASSWORD = ''; // protège le répertoire de l'enseignant par un mot de passe.`

# Remerciements :
- John Campbell (jcampbell1) : Simple PHP File Manager
