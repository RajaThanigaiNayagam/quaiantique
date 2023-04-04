
     Pour exécuter ce projet, vous devez avoir installé un serveur virtuel, c'est-à-dire XAMPP, sur votre PC (pour Windows). 


En machine localhost 
-----------------------
   Il faut télécharger et installée XAMPP serveur depuis le site internet https://www.apachefriends.org/fr/index.html. Lancer le XAMPP depuis son emplacement et démarre le serveur "Apache" et "MySQL" en cliquant sur le premier bouton "Start" ensuite le deuxième bouton "Start". Une fois, les serveurs sont démarrés, vous pouvez ouvrir le "PHPmyadmin" en cliquant sur le deuxième "Admin" bouton sur le même niveau de MySQL. Ils ouvrent la page, "PHPmyadmin" dans un navigateur, où vous pouvez gérer les basse de donnés, les tables et les données.


Création de compte Admin faite a la main. Pour ce faire, 
--------------------------------------------------------
   Ouvrez le page PHPmyadmin comme expliquée juste avant, et crée une base de données nommées "quaiantique" a la main. À l'intérieur de cette base de données "quaiantique" sur l'écran d'à droite, vous cliqué sur le bouton "Importer" juste en haut de l'écran. Sélectionné le fichier nommé "quaiantique.sql" qui se trouve dans le répertoire "Dossier support/quaiantique" et lancer l'importation en cliquant sur le bouton "Importer" tout en bas de cette page.  


Après avoir démarré Apache et MySQL dans XAMPP, suivez les étapes suivantes.

1ere étape : Ce projet est téléchargeable depuis le github.com 
		 https://github.com/RajaThanigaiNayagam/quaiantique.git
2ème étape : Créé un sous-répertoire nommé "quaiantique" a l'intérieure de la répertorier "xampp/htdocs/".   
3ème étape : Coller tous les fichiers de projet dans la répertoire "xampp/htdocs/quaiantique"


Après avoir créé la base de données, ouvrez un navigateur et accédez à l'URL "http://localhost/quaiantique".  La, vous verrez la page d'accueil de Restaurant Quantique

Admin
------
id: admin
pwd: Test@123



Utilisateur
-----------
id: test@test.com
pwd: Test@123      


         
         
         
Résumé du projet
Gestion de réservation de restaurant
------------------------------------
Nom du projet : Gestion des réservations de table de réstaurant Quai Antique.
Langue utilisée : PHP
Base de données : MySQL
Design de l’interface utilisateur : HTML, AJAX, JQUERY, JAVASCRIPT
Navigateur Web : Mozilla, Google Chrome, IE8, OPERA
Logiciel : XAMPP

Dans le système de gestion des réservations de table, j’utilisais PHP et la base de données.
MySQL. Ce projet enregistre des réservations, des clients et des services hôteliers. Le système
De gestion, des réservations d’hôtel comprennent deux modules : administrateur et utilisateur.


Module Admin
------------

1. Accueil : l’administrateur peut afficher brièvement le total des nouvelles réservations, les
réservations approuvées, les réservations annulées, le nombre total d’utilisateurs enregistrés,
Le total des demandes de lecture et le total des demandes non lues.

2. Gestion de Catégorie de plat : l’administrateur peut gérer la catégorie (ajouter/mettre à jour/supprimer).

3. Gestion de plat : L’l'administrateur peut gérer peut gérer les plat (ajouter / mettre à jour / supprimer).

4. Gestion de menu : l’administrateur peut gérer les menus. Il peut ajout, modifier et supprimer entrer Plat et dessert dans un menu

5. Gestion de Réservation : l’administrateur peut afficher les nouvelles réservations,
Annulées et également faire une remarque.

6. Utilisateurs : l’administrateur peut afficher les détails des utilisateurs enregistrés.



Module utilisateur
------------------

1. Accueil : c’est une page d’accueil pour les utilisateurs.

2. Notre carte : c'est une page qui affiche les menus et les restaurants.

3. À propos de nous : il s’agit d’une page de site web sur le restaurant Quai Antique et affiche les images plates importantes. Il se trouve sur la même page d'accueil un peu plus bas.

4. Galerie : les utilisateurs peuvent voir toutes les images de plat et menu disponible dans le restaurant.

5. Réserver une table : dans cette section, l’utilisateur peut réserver la table en s’inscrivant auprès des sites web de restaurant.

6. Nos horaires : l'utilisateur peut consulter l'horaire d'ouverture de restaurant.

7. S'inscrire : les utilisateurs peuvent s’inscrire via le bouton S'inscrire.

8. Connexion : c’est la page de connexion.

9. Mon compte : après l’inscription, l’utilisateur peut avoir son propre compte où il peut mettre à jour son profil, changer son mot de passe et voir les détails de la réservation de la table.