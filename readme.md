
     Pour exécuter ce projet, vous devez avoir installé un serveur virtuel, c'est-à-dire XAMPP, sur votre PC (pour Windows). 
Ce PHP avec code source est téléchargeable gratuitement, à utiliser uniquement à des fins éducatives !


En machine localhost 
-----------------------
   Il faut télécharger et installée XAMPP serveur depuis le site internet https://www.apachefriends.org/fr/index.html. Lancer le XAMPP depuis son emplacement et démarre le serveur "Apache" et "MySQL" en cliquant sur le premier bouton "Start" ensuite le deuxième bouton "Start". Une fois, les serveurs sont démarrés, vous pouvez ouvrir le "PHPmyadmin" en cliquant sur le deuxième "Admin" bouton sur le même niveau de MySQL. Ils ouvrent la page, "PHPmyadmin" dans un navigateur, où vous pouvez gérer les basse de donnés, les tables et les données.


Création de compte Admin faite a la main. Pour ce faire, 
--------------------------------------------------------
   Ouvrez le page PHPmyadmin comme expliquée juste avant, et crée une base de données nommées "quaiantique" a l main. À l'intérieur de cette base de données "quaiantique" sur l'écran d'à droite, vous cliqué sur le bouton "Importer" juste en haut de l'écran. Sélectionné le fichier nommé "quaiantique" qui se trouve dans le répertoire "Dossier support/quaiantique" et lancer l'importation en cliquant sur le bouton "Importer" tout en bas de cette page.  


Après avoir démarré Apache et MySQL dans XAMPP, suivez les étapes suivantes.

1ere étape : Ce projet est téléchargeable depuis le github.com 
		 https://github.com/RajaThanigaiNayagam/quaiantique.git
2ème étape : copiez le dossier principal du projet.
3ème étape : coller dans xampp/htdocs/


Après avoir créé la base de données, ouvrez un navigateur et accédez à l'URL "http://localhost/"

Admin
------
id: admin
pwd: Test@123



Utilisateur
-----------
id: test@test.com
pwd: Test@123      


         
         
         
         Gestion de réservation de réstaurant
         ------------------------------------
Nom du projet                     : Gestion des réservations de table de réstaurant Quai Antique.
Langue utilisée                   : PHP
Base de données                   : MySQL
Design de l’interface utilisateur : HTML, AJAX, JQUERY, JAVASCRIPT
Navigateur Web                    : Mozilla, Google Chrome, IE8, OPERA
Logiciel                          : XAMPP

Dans le système de gestion des réservations de table, j’utilisé PHP et la base de données
MySQL. Ce projet enregistre des réservations, des clients et des services hôteliers. Le système
de gestion des réservations d’hôtel comprend deux modules : administrateur et utilisateur.


Module Admin
------------

1. Accueil : L’administrateur peut afficher brièvement le total des nouvelles réservations, les
   réservations approuvées, les réservations annulées, le nombre total d’utilisateurs enregistrés,
   le total des demandes de lecture et le total des demandes non lues.

2. Catégorie de plat : L’administrateur peut gérer la catégorie (ajouter / mettre à jour / supprimer).

3. Gestion de plat : L’l’administrateur peut gérer les chambres (ajouter / mettre à jour / supprimer).

4. Gestion de plat : L’administrateur peut gérer les menu.  Il peut ajout, modifier et supprimer Entrer, 
   plat et dessert dans un menu

5. Gestion de Réservation : L’administrateur peut afficher les nouvelles réservations et
   annulées et également faire une remarque.

6. Utilisateurs  : L’administrateur peut afficher les détails des utilisateurs enregistrés.



   Module utilisateur
   ------------------

1. Accueil : C’est une page d’accueil pour les utilisateurs.

2. À propos de nous : Il s’agit d’une page de site web sur le restaurant Quai Antique et affiche les images plates importantes. Il se trouve sur la   même page d'accueil un peu plus bas. 

3. Services : Les utilisateurs peuvent afficher les services fournis par l’organisation.

4. Galerie : Les utilisateurs peuvent voir toutes les images de plat et menu disponible dans le restaurant.

5. categorie des chambres : L’utilisateur peut voir la plusieur categories des chambres de l’hôtel.

6. Réserver une chambre : Dans cette section, l’utilisateur peut réserver la chambre d’hôtel
   en s’inscrivant auprès des hôtels.

7. Contact : C’est une page contactez-nous où les utilisateurs peuvent envoyer les requêtes à
   l’hôtel.

8. Inscrivez-vous : Les utilisateurs peuvent s’inscrire via le signe signup.

9. Connexion : C’est la page de connexion.

10. Mon compte : Après l’inscription, l’utilisateur peut avoir son propre compte   où  il peut mettre à jour son profil, changer son mot de passe, récupérer son mot de passe et voir les détails de la réservation de la chambre d’hôtel.
