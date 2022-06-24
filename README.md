# Projet_Web_2022
Projet WEB réalisé par Arnaud Peyrache et Mickaël Neroda

////PRÉSENTATION////

Il s'agit d'une application web de gestion de matchs sportifs.
Il est possible de réserver une place en tant que participants et de proposer son propre évènement (match).

////LANCEMENT DU PROJET////

Afin de déployer l'application sur le serveur, il est nécessaire d'installer et de démarrer sur celui-ci un serveur apache ainsi que le service postgresql.
Pour se connecter à la VM :
login : user2
mot de passe : 123456789

Accès à la base de données : 
login : postgres
mdp => new_password

Ensuite il faut créer les tables SQL à l'aide du fichier .sql fourni.
Pour les remplir, nous utiliserons le script PHP fill_database.php. Celui-ci se connectera à la base de donnée et la remplira automatiquement avec des informations tests.

////UTILISATION DE L'APPLICATION////

Pour se rendre sur le site WEB il faut être connecté sur le réseau de l'ISEN puis rentrer l'URL suivante dans un navigateur : http://10.10.51.60/Projet_Web_2022/index.php .
Il est possible de se connecter ou bien de créer un nouveau compte.
La connexion établie vous pourrez faire des recherches ou organiser des matchs, mais aussi consulter votre profil.
Quelques utilisateurs tests du site :
login : mickael.neroda@gmail.com
mot de passe : aze
login : arnaud.peyrache@gmail.com
mot de passe : aze
          À noter que tous les utilisateurs tests on le même mot de passe : aze
