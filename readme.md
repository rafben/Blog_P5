# Blog Classrooms

Projet Open Classrooms de blog P5

## Information du projet 

Projet de la formation ***Développeur d'application - PHP / Symfony***.

**Créez votre premier blog en PHP** - [Lien de la formation](https://openclassrooms.com/fr/paths/59-developpeur-dapplication-php-symfony)

## Descriptif du besoin du client

Voici la liste des pages qui devront être accessibles depuis votre site web :
 
*   la page d'accueil
*   la page listant l’ensemble des blogs posts
*   la page affichant un blog post
*   la page permettant d’ajouter un blog post
*   la page permettant de modifier un blog post
*   les pages permettant de modifier/supprimer un blog post
 
Vous développerez une partie administration qui devra être accessible uniquement aux utilisateurs inscrits et validés.
 
Sur la page d’accueil il faudra présenter les informations suivantes :
 
*   Votre nom et prénom
*   Une photo et/ou un logo
*   Une phrase d’accroche exemple : “Rafik Bengrid, le développeur PHP/Symphony” ;
*   Un menu permettant de naviguer parmi l’ensemble des pages de votre site web ;
*   Un formulaire de contact, à la soumission de ce formulaire, un email avec toutes ces informations vous serons envoyé
*   Un lien permettant de consulter votre CV au format pdf
*   L’ensemble des liens vers les réseaux sociaux où l’on peut vous suivre (Github, LinkedIn, Twitter, Facebook…)
 
Sur la page listant tous les blogs posts (du plus récent au plus ancien), il faut afficher les informations suivantes pour chaque blog post :
 
*   Le titre
*   La date de dernière modification
*   Le châpo
*   Et un lien vers le blog post
 
Sur la page présentant le détail d’un blog post, il faut afficher les informations suivantes :
 
*   Le titre
*   Le chapô
*   Le contenu
*   L’auteur
*   La date de dernière mise à jour
*   Le formulaire permettant d’ajouter un commentaire
*   Les listes des commentaires validés et publiés

## Installer le projet 

*   Mettre en place la Base de données, importer le fichier blogpoo/blogpoo.sql afin d'y créer les différentes tables
*   Cloner le projet
*   Installer les dépendances du projet en executant la commande composer install
*   Votre blog est désormais fonctionnel ! Vous pouvez y créer un compte dans l'onglet "Inscription" sans oublier de cliquer sur le lien de validation de votre email. Ensuite, dans votre base de données et dans la table "user", modifier la colonne "usertype" de l'utilisateur que vous venez de créer et mettez y la valeur 1. Enregistrer, vous disposez désormais d'un compte administrateur qui vous permet de gérer votre blog via le menu "Administration"
*   Ouvrir le fichier index.php à la racine du projet, et mettre à jour la ligne 11 si le nom de votre projet est différent de Blog_P5 ou si le projet n'est pas directement à la racine de votre serveur web 
*   Veuillez créer une base de donnée nommée blogpoo, si vous êtes dans un environnement où les identifiants pour se connecter à la base de donnée sot diffèrent de:
    Username: 'root'
    Password: ''
    Il vous faut éditer le fichier Database.php situe dans le dossier vendor/rafik/src et  modifier la ligne 17 afin d'y mettre vos identifiants de base de données.

## Modéle MVC

Utilisation du modéle MVC d'un de mes projets personnels :

*   [Projet](https://github.com/rafben/Blog_P5)




