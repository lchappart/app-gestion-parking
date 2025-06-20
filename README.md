# ParkHeure

Bienvenue sur **ParkHeure**, l'application de gestion de parking qui vous permet de réserver facilement une place de stationnement, gérer vos véhicules et suivre vos réservations.

## Fonctionnalités principales

- **Création de compte** : Inscrivez-vous pour accéder à toutes les fonctionnalités.
- **Connexion** : Accédez à votre espace personnel en toute sécurité.
- **Gestion des véhicules** : Ajoutez, modifiez ou supprimez vos voitures.
- **Réservation de place** : Réservez une place de parking selon vos besoins.
- **Suivi des réservations** : Consultez l'historique et le statut de vos réservations.
- **Profil utilisateur** : Modifiez vos informations personnelles à tout moment.

---

# Guide d'installation
---
## 1. Clonage du repository

Exécutez la commande suivante dans un terminal : 
```bash
git clone https://github.com/lchappart/app-gestion-parking.git
````

## 2. Installer les librairies
Si vous n'avez pas composer d'installé, vous devrez alors le faire à ce [lien](https://getcomposer.org/)
```bash
cd app-gestion-parking
composer install
```

## 3. Importer la BDD
Vous pouvez importer la base de données depuis le fichier ```parking_app.sql```

## 4. Connexion à la BDD
Exécutez la commande suivante dans un terminal
```bash
cp .env.dist .env
nano .env
```
Puis modifier le fichier avec vos informations
```
DB_HOST= // L'hôte de votre base de données
DB_NAME= // Le nom de votre base de données
DB_USER= // L'utilisateur qui peut modifier la base de données
DB_PASS= // Le mot de passe de l'utilisateur
```

## 5. Utilisez l'application !

Vous pouvez maintenant utiliser l'application selon le guide utilisateur !

---

# Guide Utilisateur

---

## 1. Inscription

1. Rendez-vous sur la page d'accueil.
2. Cliquez sur **Créer un compte**.
3. Remplissez le formulaire avec vos informations (nom, email, mot de passe, etc.).
4. Validez pour accéder à votre espace personnel.

## 2. Connexion

1. Cliquez sur **Se connecter**.
2. Entrez votre email et mot de passe.
3. Accédez à votre tableau de bord utilisateur.

## 3. Ajouter un véhicule

1. Dans le menu, sélectionnez **Mes véhicules**.
2. Cliquez sur **Ajouter un véhicule**.
3. Renseignez les informations du véhicule (marque, modèle, plaque d'immatriculation).
4. Enregistrez.

## 4. Réserver une place de parking

1. Allez dans la section **Réserver une place**.
2. Choisissez la date, l'heure et la durée souhaitées.
3. Sélectionnez le véhicule à utiliser.
4. Confirmez la réservation.

## 5. Gérer vos réservations

- Consultez la liste de vos réservations dans **Mes réservations**.
- Annulez ou modifiez une réservation si besoin (selon les conditions).

## 6. Modifier votre profil

- Accédez à **Mon profil** pour mettre à jour vos informations personnelles ou changer votre mot de passe.

# Guide Administrateur

Bienvenue dans l'espace **Administrateur** de ParkHeure. Cette section vous explique comment gérer efficacement le parking, les utilisateurs et les réservations.

## Fonctionnalités principales (Administrateur)

- **Gestion des utilisateurs** : Visualisez, ajoutez, modifiez ou supprimez des comptes utilisateurs.
- **Gestion des véhicules** : Consultez les véhicules enregistrés par les utilisateurs.
- **Gestion des places de parking** : Ajoutez, modifiez ou supprimez des places disponibles.
- **Gestion des réservations** : Surveillez, ou annulez les réservations.
- **Gestion des tarifs** : Définissez ou ajustez les tarifs de stationnement.
- **Tableau de bord** : Accédez à une vue d'ensemble de l'activité du parking.

---

## 1. Connexion à l'espace administrateur

1. Accédez à la page de connexion.
2. Entrez vos identifiants administrateur.
3. Accédez au tableau de bord d'administration.

## 2. Gérer les utilisateurs

- Accédez à la section **Utilisateurs**.
- Visualisez la liste des utilisateurs inscrits.
- Ajoutez un nouvel utilisateur ou modifiez/supprimez un compte existant.

## 3. Gérer les véhicules

- Consultez la liste des véhicules enregistrés par les utilisateurs.
- Supprimez un véhicule si nécessaire (ex : véhicule non autorisé).

## 4. Gérer les places de parking

- Accédez à la section **Places**.
- Ajoutez de nouvelles places, modifiez ou supprimez des places existantes.

## 5. Gérer les réservations

- Consultez toutes les réservations en cours et passées.
- Annulez/Supprimez une réservation.

## 6. Gérer les tarifs

- Accédez à la section **Tarifs**.
- Modifiez les prix selon la politique du parking.
