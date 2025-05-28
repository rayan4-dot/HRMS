# Human Resource Management (HRMS) 

Le module **Human Resource Management System (HRMS)** permet aux entreprises de gérer efficacement leurs employés, départements, et hiérarchies. Ce projet est développé sous **Laravel 11** en suivant les bonnes pratiques et en utilisant des packages adaptés pour simplifier la gestion des rôles, des documents, des présences, et des notifications.

---

## Installation

1. **Cloner le projet**

   ```bash
   git clone https://github.com/rayan4-dot/HRMS.git
   cd HRMS
   ```

2. **Installer les Dépendances Backend**

   Installez les dépendances PHP du projet via Composer :

   ```bash
   composer install
   ```

3. **Installer les Dépendances Frontend**

   Installez les dépendances JavaScript et compilez les assets :

   ```bash
   npm install
   npm run build
   ```

4. **Configurer l'Environnement**

   Copiez le fichier `.env.example` vers un fichier `.env` et générez la clé de l'application :

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Ensuite, modifiez le fichier `.env` pour configurer votre base de données et les autres paramètres nécessaires, comme les informations de connexion SMTP si vous utilisez les notifications par email.

5. **Exécuter les Migrations et Seeders**

   Appliquez les migrations pour créer les tables dans la base de données :

   ```bash
   php artisan migrate
   ```

   Si des seeders sont nécessaires pour peupler la base de données avec des données par défaut, exécutez-les :

   ```bash
   php artisan db:seed
   ```

6. **Démarrer le Serveur de Développement**

   Lancez le serveur local de Laravel :

   ```bash
   php artisan serve
   ```

   L'application sera maintenant accessible à l'adresse `http://localhost:8000`.

---

## Configuration de l'Environnement

Le fichier `.env` contient des variables importantes que vous devez configurer :

### Base de données

Assurez-vous que les paramètres de la base de données sont corrects.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=company
DB_USERNAME=root
DB_PASSWORD=
```

---

## Routes et Contrôleurs

Les routes du projet sont organisées en fonction des rôles des utilisateurs (Admin, Manager, HR, Employee). Voici un résumé des routes disponibles :

### Routes d'authentification

- **`/login`** : Page de connexion
- **`/dashboard`** : Tableau de bord accessible aux utilisateurs authentifiés

### Routes Admin

- **`/departments`** : Gestion des départements
- **`/jobs`** : Gestion des postes
- **`/contracts`** : Gestion des contrats
- **`/formations`** : Gestion des formations

### Routes HR

- **`/vacation-approvals`** : Gestion des approbations de congés
- **`/recovery-approval`** : Gestion des approbations de jours de récupération

### Routes Manager

- **`/employees`** : Gestion des employés
- **`/vacation-approvals`** : Approbation des congés des employés

### Routes Employé

- **`/vacations`** : Demande de congé
- **`/recovery-days`** : Demande de jours de récupération
- **`/profile`** : Profil de l'employé

### Routes pour Exporter les Données

- **`/employees/export`** : Export des données des employés au format Excel

### Routes d'Organigramme

- **`/hierarchy`** : Affiche l'organigramme de l'entreprise

---

## Structure des Fichiers

Voici la structure de base des répertoires et fichiers dans le projet :

- **`app/Http/Controllers/`** : Contient les contrôleurs pour gérer les différentes fonctionnalités (ex. EmployeeController, DashboardController).
- **`app/Livewire/`** : Contient les composants Livewire pour la gestion des départements, postes, contrats, et formations.
- **`resources/views/`** : Les vues de l'application (utilisées avec Blade ou Livewire).
- **`routes/web.php`** : Définit toutes les routes de l'application, protégées par les rôles des utilisateurs.
- **`database/migrations/`** : Les fichiers de migration pour créer les tables de la base de données.
- **`app/Exports/`** : Contient la classe pour exporter les employés en fichier Excel.
