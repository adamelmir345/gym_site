# FitNess.ma - Backend API (Laravel 11)

Ce projet contient l'API REST complète et le back-office d'administration pour la plateforme FitNess.ma.
Il a été développé avec **Laravel 11**, **Sanctum** (pour l'authentification), **Spatie Permission** (rôles) et **Filament** (pour l'administration).

## 🚀 Prérequis

- PHP >= 8.2
- Composer
- SQLite (par défaut) ou MySQL

## ⚙️ Installation Rapide

1. **Aller dans le dossier backend :**
   ```bash
   cd backend
   ```

2. **Installer les dépendances :**
   ```bash
   composer install
   ```

3. **Générer la clé d'application (si non fait) :**
   ```bash
   php artisan key:generate
   ```

4. **Migrer et populer la base de données :**
   Le projet est pré-configuré avec SQLite.
   ```bash
   php artisan migrate:fresh --seed
   ```
   > **Note:** Le seeder crée automatiquement deux utilisateurs :
   > - Admin : `admin@fitness.ma` / `password` (Accès au back-office)
   > - Membre : `member@fitness.ma` / `password`

5. **Démarrer le serveur local :**
   ```bash
   php artisan serve
   ```
   L'API sera disponible sur `http://localhost:8000/api`.
   Le panneau d'administration sur `http://localhost:8000/admin`.

## 🛡️ Endpoints de l'API REST

Toutes les routes commencent par `/api/`.

### 👤 Authentification
- `POST /register` : Créer un compte
- `POST /login` : Obtenir un token d'accès Sanctum
- `POST /logout` : Se déconnecter (Nécessite le Header `Authorization: Bearer <token>`)
- `GET /user` : Informations de l'utilisateur connecté

### 🏋️‍♂️ Coachs & Clubs
- `GET /coaches` : Liste des coachs
- `GET /coaches/{id}` : Détails d'un coach
- `GET /locations` : Liste des clubs / salles

### 💳 Abonnements
- `GET /plans` : Voir les offres d'abonnement actives
- `POST /subscriptions` : Souscrire à un plan (Nécessite Auth) `{"plan_id": 1}`

### 🛒 E-commerce / Boutique
- `GET /categories` : Liste des catégories
- `GET /products` : Liste des produits
- `GET /orders` : Historique des commandes de l'utilisateur connecté
- `POST /orders` : Créer une commande (Nécessite Auth)
  *Exemple JSON :*
  ```json
  {
      "shipping_address": "123 Rue de la forme",
      "items": [
          {"product_id": 1, "quantity": 2, "price": 650.00}
      ]
  }
  ```

### ✉️ Contact
- `POST /contact` : Envoyer un message via le formulaire

## 🖥️ Back-Office (Filament)

Filament a été configuré pour gérer l'intégralité du contenu :
Rendez-vous sur **`/admin`** et connectez-vous avec `admin@fitness.ma` / `password`.
Vous pourrez y gérer les coachs, produits, commandes, utilisateurs, etc.
