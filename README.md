# Documentation du Projet Todo-List

## Table des matières
- [Vue d'ensemble](#vue-densemble)
- [Architecture](#architecture)
- [Installation](#installation)
- [Configuration](#configuration)
- [API Documentation](#api-documentation)
- [Frontend Documentation](#frontend-documentation)
- [Structure de la Base de Données](#structure-de-la-base-de-données)
- [Fonctionnalités](#fonctionnalités)
- [Tests](#tests)
- [Déploiement](#déploiement)
- [Support et Maintenance](#support-et-maintenance)

## Vue d'ensemble
Application de gestion de tâches (Todo-List) construite avec Laravel (backend) et React (frontend) utilisant une architecture CQRS.

### Technologies utilisées
- **Backend** : Laravel 10.x
- **Frontend** : React 18.x
- **Base de données** : MySQL
- **Authentication** : Laravel Sanctum

## Architecture

### Backend (Laravel)
L'application suit le pattern CQRS (Command Query Responsibility Segregation) :

#### Controllers
- `TodoQueryController` : Gestion des lectures
- `TodoCommandController` : Gestion des écritures
- `AuthController` : Gestion de l'authentification

### Frontend (React)
- `App.js` : Composant principal gérant l'authentification
- `TodoApp.jsx` : Gestion des todos
- `AuthForm.jsx` : Formulaires de connexion/inscription

## Installation

### Prérequis
```bash
- PHP >= 8.1
- Composer
- Node.js >= 14.x
- MySQL
```

### Backend (Laravel)
```bash
# Cloner le projet
git clone [url-du-projet]

# Installation des dépendances
composer install

# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé d'application
php artisan key:generate

# Configuration de la base de données dans .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Migrations et seeders
php artisan migrate --seed

# Démarrer le serveur
php artisan serve
```

### Frontend (React)
```bash
# Dans le dossier frontend
npm install
npm start
```

## Configuration

### Configuration CORS (config/cors.php)
```php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:3000'],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
```

## API Documentation

### Routes d'authentification
```
POST /api/register
{
    "firstName": "string",
    "lastName": "string",
    "email": "string",
    "password": "string",
    "phoneNumber": "string"
}

POST /api/login
{
    "email": "string",
    "password": "string"
}
```

### Routes Todo

#### Requêtes (Query)
```
GET /api/todos
Réponse: Array de todos

GET /api/todos/{id}
Réponse: Todo spécifique
```

#### Commandes (Command)
```
POST /api/todos
Body: {
    "name": "string"
}

PUT /api/todos/{id}
Body: {
    "name": "string",
    "completed": boolean
}

DELETE /api/todos/{id}
```

### Structure des réponses
```json
// Todo object
{
    "id": number,
    "name": string,
    "completed": boolean,
    "user_id": number,
    "created_at": timestamp,
    "updated_at": timestamp
}
```

## Structure de la Base de Données

### Table: users
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Table: todos
```sql
CREATE TABLE todos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    name VARCHAR(255) NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    completed_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

## Fonctionnalités

### Authentication
- Inscription utilisateur
- Connexion utilisateur
- Déconnexion
- Protection des routes

### Gestion des Todos
- Affichage des todos de l'utilisateur connecté
- Création d'une nouvelle todo
- Modification d'une todo existante
- Suppression d'une todo
- Marquage comme complété/non-complété

### Événements
Le système utilise des événements Laravel pour les actions sur les todos :
- `TodoCreated`
- `TodoUpdated`
- `TodoDeleted`

### Sécurité
- Authentification via Laravel Sanctum
- Validation des données
- Protection CSRF
- Vérification de propriété des todos

## Tests

### Backend
```bash
php artisan test
```

### Frontend
```bash
npm test
```

## Déploiement
1. Configuration du serveur web (Apache/Nginx)
2. Configuration des variables d'environnement
3. Compilation des assets frontend
4. Migration de la base de données
5. Configuration des tâches CRON si nécessaire

## Support et Maintenance
Pour signaler un bug ou proposer une amélioration, veuillez créer une issue sur le dépôt du projet.
