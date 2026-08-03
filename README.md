# 🏋️‍♂️ FitNess.ma - Plateforme Complète de Gestion de Salle de Sport


**FitNess.ma** est une application web complète (Frontend statique "Premium" + Backend API & Admin) conçue pour la gestion moderne d'un club de fitness. Elle intègre un système d'abonnement, une vitrine pour les coachs, une boutique de compléments/équipements, et un back-office intégral pour l'administration.

---

## ✨ Fonctionnalités Principales

### 🌐 Frontend (Site Web Public)
Une interface vitrine ultra-moderne développée en **HTML5 & CSS3 Pur** (sans framework lourd, approche Mobile-First).
- **Thème Sombre & Glassmorphism** pour un rendu premium.
- **Pages interactives :** Accueil, À propos (Coachs), Localisations, Contact.
- **Boutique en ligne :** Catalogue de produits (Protéines, Équipements) avec panier.
- **Abonnements :** Présentation des formules et tarification.

### ⚙️ Backend (API REST & Back-office)
Une architecture robuste propulsée par **Laravel 11**, **MySQL** et **Filament v3**.
- **API RESTful :** Connecte le frontend aux données en temps réel via des tokens sécurisés (Sanctum).
- **Espace Membre :** Authentification, souscription aux plans, historique des commandes.
- **Panel d'Administration (Filament) :** Interface graphique fluide (assortie aux couleurs du site public) permettant de gérer :
  - Les utilisateurs et leurs rôles (Spatie Permission).
  - Le CRUD complet des Coachs, des Plans d'abonnement et des Clubs.
  - La boutique e-commerce (Catégories, Produits, Commandes).
  - Les messages de contact.

---

## 🛠️ Stack Technique

- **Frontend :** HTML5 Sémantique, CSS3 (Variables, Flexbox, Animations), JavaScript (Vanilla)
- **Backend :** PHP 8.2+, Laravel 11
- **Base de Données :** MySQL
- **Outils :** Filament Admin Panel v3, Laravel Sanctum, Spatie Permission

---

## 🚀 Installation & Lancement

Si vous souhaitez cloner et tester le projet en local, voici la marche à suivre :

### 1. Démarrer le Frontend (Site Vitrine)
Vous pouvez utiliser n'importe quel serveur HTTP statique. Par exemple, avec Python :
```bash
# À la racine du projet
python3 -m http.server 8080
```
👉 Accédez à `http://localhost:8080`

### 2. Démarrer le Backend (API & Admin)
```bash
# Entrez dans le dossier backend
cd backend

# Installez les dépendances PHP
composer install

# Configurez votre base de données dans le fichier .env
cp .env.example .env
php artisan key:generate

# Lancez les migrations et les seeders (données de démonstration)
php artisan migrate:fresh --seed

# Démarrez le serveur local Laravel
php artisan serve --port=8001
```
👉 L'administration est accessible sur `http://localhost:8001/admin`
👉 **Comptes de test par défaut :**
- **Admin:** `admin@fitness.ma` / `password`
- **Membre:** `member@fitness.ma` / `password`

---
*Développé avec passion pour le fitness moderne.* 🚀
