
Description du projet
Ce projet, développé dans le cadre du cours d'applications web avancées pour l'année universitaire 2024-2025, consiste en la création d'une application web permettant aux utilisateurs de :

Localiser les centres de recyclage
Apprendre les meilleures pratiques pour réduire les déchets
Organiser des collectes de déchets communautaires
Chaque membre de l'équipe est responsable de la gestion de deux entités distinctes avec les opérations CRUD associées, intégrées dans un back-office et un front-office utilisant Blade.

Fonctionnalités
Gestion des centres de recyclage : Localisation des centres et informations disponibles.
Collectes communautaires : Création et gestion des événements de collecte de déchets.
Meilleures pratiques de réduction des déchets : Documentation et conseils pour une gestion écologique.
Authentification des utilisateurs : Système de gestion des utilisateurs avec rôles (admin et utilisateur).
CRUD sur plusieurs entités : Chaque étudiant a développé deux entités distinctes avec les opérations CRUD nécessaires.
Formulaires avancés : Validation et gestion des formulaires avec des règles de validation robustes.
Prérequis
Avant d'installer et de lancer le projet, assurez-vous d'avoir installé les outils suivants :

PHP >= 8.0
Composer
Laravel 9
MySQL ou toute autre base de données compatible
Git
Installation
Suivez ces étapes pour installer et configurer le projet localement :

Clonez le dépôt GitHub :

git clone https://github.com/samarrebhi/5TWIN6_WebCrew_Laravel_Project.git
Accédez au répertoire du projet :

cd 5TWIN6_WebCrew_Laravel_Project
Installez les dépendances du projet :


composer install
Créez un fichier .env en dupliquant le fichier .env.example :


cp .env.example .env
Configurez les variables d'environnement dans le fichier .env (notamment la base de données).

Générez une clé d'application Laravel :


php artisan key:generate
Exécutez les migrations pour configurer la base de données :

php artisan migrate
Démarrez le serveur local :


php artisan serve
Utilisation
Une fois le projet installé, vous pouvez accéder à l'application à l'adresse suivante : http://localhost:8000.

Le projet est divisé en deux parties :

Front-office : Interface utilisateur permettant de localiser les centres, visualiser les événements et consulter les conseils de recyclage.
Back-office : Tableau de bord pour les administrateurs afin de gérer les entités et les événements de collecte.
Technologies utilisées
Laravel 9 : Framework PHP pour le développement web.
Blade : Moteur de template pour le front et back office.
MySQL : Base de données relationnelle pour stocker les informations.
Bootstrap : Pour le design responsive et les interfaces utilisateurs.
Contributions
Les contributions sont les bienvenues ! Pour contribuer, suivez ces étapes :

Forkez le projet
Créez une branche pour vos modifications (git checkout -b feature/nouvelle-fonctionnalité)
Commitez vos modifications (git commit -m 'Ajouter une nouvelle fonctionnalité')
Poussez vos changements (git push origin feature/nouvelle-fonctionnalité)
Ouvrez une Pull Request
Licence
Ce projet est sous licence MIT. Vous pouvez consulter les termes de la licence dans le fichier LICENSE.md.

