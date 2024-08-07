# BillMo API - Créez un web service exposant une API

Dans le cadre du projet n°7 de la formation Développeur d'application - PHP/Symfony de OpenClassrooms,
ce site web est une API proposant un catalogue de produits BillMo.


## PRÉREQUIS

- PHP version 8.2 ou supérieur
- Symfony 7.1 ou supérieur
- Apache server version 2.4 ou supérieur
- Composer
- Base de données MYSQL


## INSTALLATION

- Cloner le projet sur GitHub [Lien vers le projet GitHub](https://github.com/Saydrick/BillMo) et l’ajouter dans le dossier des projets de votre environnement de serveur apache local avec la commande :
```
git clone https://github.com/Saydrick/BillMo.git
```
- Créer une base de données en local nommée "billmo" et importer le fichier "billmo.sql" qui se trouve à la racine du projet.
- Mettre à jour le fichier `.env` avec les identifiants de connexion à votre base de données.
- Exécuter `composer install` à la racine du projet pour installer les bibliothèques du projet.

## UTILISATION

Toutes les routes de l'API peuvent être utilisées et testées directement depuis la documentation interactive disponible à l'URL suivante :
[Lien vers la documentation de l'API](http://localhost:8000/api/doc)

### Connexion
Se connecter sur le site en recupérant un token via la route '/api/login_check' avec les identifiants suivants :

{
  "username": "admin@billmoapi.com",
  "password": "password"
}

puis ajouter le token dans la zone 'Authorize' en préfixant le token de 'bearer '.

### Fonctionnalités
Les principales fonctionnalités du projet accessibles suivant le type d'utilisateur connecté sont :

Tous types d'utilisateurs (connectés ou non) :
- Récupération de token d'authentification.

Utilisateur connecté :
- Voir le catalogue de produit.
- Voir le détail d'un produit.
- Voir les utilisateurs liés à un client.
- Voir le détail d'un utilisateur.
- Ajouter un nouvel utilisateur.
- Supprimer un utilisateur.

Administrateur :
- Voir la liste des clients.

## BIBLIOTHÈQUES UTILISÉES

Doctrine
Nelmio
JWT
Twig

## BADGE SYMFONY INSIGHT
[![SymfonyInsight](https://insight.symfony.com/projects/5df3a384-b697-4fcf-809b-3192cb740602/small.svg)](https://insight.symfony.com/projects/5df3a384-b697-4fcf-809b-3192cb740602)

## AUTEUR

BOUZANQUET Cédric
