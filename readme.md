
Pour exécuter ce projet, vous devez avoir installé un serveur virtuel, c'est-à-dire XAMPP, sur votre PC (pour Windows). 
Ce PHP avec code source est téléchargeable gratuitement, à utiliser uniquement à des fins éducatives !

Après avoir démarré Apache et MySQL dans XAMPP, suivez les étapes suivantes.

1ere étape : Ce projet est téléchargeable depuis le github.com 
		 https://github.com/RajaThanigaiNayagam/hotelanan.git
2ème étape : copiez le dossier principal du projet.
3ème étape : coller dans xampp/htdocs/

4ème étape : ouvrez un navigateur et accédez à l'URL "http://localhost/phpmyadmin/"
5ème étape : ensuite, cliquez sur l'onglet bases de données.
6ème étape : créez une base de données en la nommant "hotelanan" puis cliquez sur l'onglet import
7ème étape : cliquez sur Parcourir le fichier et sélectionnez le fichier "/sql/database.sql" qui se trouve dans le dossier "Database"
8ème étape : cliquez sur go.

Après avoir créé la base de données,

9ème étape : ouvrez un navigateur et accédez à l'URL "http://localhost/"

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

2. Catégorie de plat : L’administrateur peut gérer la catégorie (ajouter / supprimer).

3. Gestion de plat : L’l’administrateur peut gérer les chambres (ajouter / mettre à jour).

4. Page : L’administrateur peut gérer les pages ‘about us’ et ‘contact us’.

5. Réservation : L’administrateur peut afficher les nouvelles réservations approuvées et
   annulées et également faire une remarque.

6. Utilisateurs Enreg : L’administrateur peut afficher les détails des utilisateurs enregistrés.

7. Enquête : L’administrateur peut afficher et gérer la demande.

8. Recherche : L’administrateur peut rechercher les détails de la réservation à l’aide de son
   numéro de téléphone portable et de son numéro de réservation respectivement.

9. Rapports : L’administrateur peut afficher les détails de la demande et vérifier les détails de
   la réservation au cours d’une période particulière.  L’administrateur peut également mettre à jour son profil, changer le mot de passe et récupérer le mot de passe.  
   

   Module utilisateur
   ------------------



1. Home : C’est une page d’accueil pour les utilisateurs.

2. À propos : Il s’agit d’une page de site Web sur nous.

3. Services : Les utilisateurs peuvent afficher les services fournis par l’organisation.

4. Chambre : L’utilisateur peut voir les détails de la chambre disponible dans l’hôtel.

5. categorie des chambres : L’utilisateur peut voir la plusieur categories des chambres de l’hôtel.

6. Réserver une chambre : Dans cette section, l’utilisateur peut réserver la chambre d’hôtel
   en s’inscrivant auprès des hôtels.

7. Contact : C’est une page contactez-nous où les utilisateurs peuvent envoyer les requêtes à
   l’hôtel.

8. Inscrivez-vous : Les utilisateurs peuvent s’inscrire via le signe signup.

9. Connexion : C’est la page de connexion.

10. Mon compte : Après l’inscription, l’utilisateur peut avoir son propre compte   où  il peut mettre à jour son profil, changer son mot de passe, récupérer son mot de passe et voir les détails de la réservation de la chambre d’hôtel.
