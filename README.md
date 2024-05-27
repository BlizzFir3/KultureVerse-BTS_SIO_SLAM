# KultureVerse-BTS_SIO_SLAM

Projet BTS SIO SLAM KultureVerse

# Instalation

-   Telecharger le code source
-   Lancer WAMP SERVER
-   Extraire le code source dans le dossier wamp64/www/KultureVerse
-   Ouvrir phpmyadmin
-   Importer le script SQL fournit dans le code source
-   Ouvrir localhost/KultureVerse

    _PS : Si vous ajouter un nouveau quizz veillez a bien mettre l'URL de l'image et non pas une image directement_

# Utilisation

## Se connecter

-   Derouler le menu deroulant avec les boutons en forme de burger en haut a gauche
-   Cliquer sur Se Connecter
-   Entrer les informations du compte (nom d'utilisateur ou adresse mail et mot de passe)

## Pour ajouter modifier ou spprimer des quizz ou des questions :

### 1. Quizz

-   Derouler le menu deroulant avec les boutons en forme de burger en haut a gauche
-   Cliquez sur Se Connecter
-   Se connecter avec un compte admin fournit
-   Vous etes rediriger vers la page de gestion des quizz depuis laquelle vous pouvez ajouter, modifier ou supprimer un quizz

### 2. Questions

-   Depuis la page de gestion des quizz, cliquez sur le bouton consulter sur la ligne du quizz dont vous souhaitez modifier les questioins
-   Vous etes rediriger vers la page de gestion des questions du quizz depuis laquelle vous pouvez ajouter, modifier ou supprimer des questions

## Pour creer un compte utilisateur :

-   Se deconnecter du compte administrateur si vous etes connecter avec ce type de compte
-   Derouler le menu deroulant avec les boutons en forme de burger en haut a gauche
-   Cliquez sur S'inscrire
-   Creez votre compte avec les informations que vous desirez
-   Vous etes rediriger vers la page de connexion
-   Connectez vous avec les informations que vous avez utiliser

## Pour creer un compte admin

-   Creer un compte utilisateur
-   Dans phpmyadmin : dans la table user, sur la ligne du compte concerner changer la colonne isAdmin (0) en 1

## Faire un quizz pour tester vos connaissances :

-   Connectez vous
-   Rendez vous sur la page d'accueil du site
-   Cliquer sur le bouton vert en dessous du quizz qui vous interesse
-   Repondez par oui ou non a chacune des questions
-   Cliquez sur le bouton vert en bas de la page
-   Votre score s'affiche a l'ecran
