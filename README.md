# MyLibrary

Application web de gestion d'une bibliothèque, réalisée pour l'évaluation de dispense
de l'UE « Projet de développement Web » (IRAM).

**Technologies :** Laravel 13, Livewire 4, MySQL, Blade, Tailwind CSS (via Vite), JavaScript (`fetch`).

## Fonctionnalités

- Inscription, connexion et déconnexion (formulaires écrits à la main) ; connexion Google en option.
- Gestion des livres avec Livewire : ajout, modification et suppression de ses propres livres
  (titre, ISBN-10/13 vérifié, catégorie, prix, photo de couverture et photo du dos).
- Catégories créées par un Seeder qui lit `database/data/categories.csv` et normalise les noms.
- Listes Livewire « Mes livres » et « Tous les livres », filtrables par catégorie, paginées.
- API JSON `GET /api/livres`, réservée aux utilisateurs connectés (Laravel Sanctum).
- « Page API » : tableau HTML rempli en JavaScript à partir de l'API.

## Prérequis

- PHP 8.4 ou plus récent, avec les extensions `pdo_mysql`, `mbstring`, `fileinfo`
- Composer
- Node.js (version LTS) et npm
- MySQL 8

## Installation

1. Récupérer le projet et installer les dépendances :

   ```bash
   git clone https://github.com/Mattanui/mylibrary.git
   cd mylibrary
   composer install
   npm install
   ```

2. Créer la base de données (dans MySQL) :

   ```sql
   CREATE DATABASE mylibrary CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

3. Configurer l'environnement :

   ```bash
   cp .env.example .env        # sous Windows PowerShell : Copy-Item .env.example .env
   php artisan key:generate
   ```

   Dans `.env`, adapter si nécessaire `DB_USERNAME` et `DB_PASSWORD`.

4. Créer les tables, charger les catégories depuis le CSV et rendre les images accessibles :

   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```

5. Lancer l'application (deux terminaux) :

   ```bash
   php artisan serve
   npm run dev
   ```

6. Ouvrir **http://localhost:8000** (et non `127.0.0.1:8000`), puis créer un compte via « Inscription ».

> Sans `npm run dev`, il est aussi possible de compiler une fois les fichiers CSS/JS avec `npm run build`.

## Connexion Google (facultative)

Le bouton « Continuer avec Google » n'apparaît que si les identifiants Google sont renseignés dans `.env` :

```env
GOOGLE_CLIENT_ID=...
GOOGLE_CLIENT_SECRET=...
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

Sans ces valeurs, l'application fonctionne normalement avec l'inscription classique.

## Pages principales

| Adresse | Contenu | Accès |
|---|---|---|
| `/inscription`, `/connexion` | Authentification | Visiteurs |
| `/livres` | Tous les livres | Connecté |
| `/mes-livres` | Mes livres (modifier, supprimer) | Connecté |
| `/livres/ajouter`, `/livres/{id}/modifier` | Formulaire Livewire | Connecté (propriétaire pour la modification) |
| `/page-api` | Tableau rempli en JavaScript via l'API | Connecté |
| `/api/livres` | API JSON | Connecté (appel depuis les pages du site) |

## Organisation du code

| Élément | Emplacement |
|---|---|
| Migrations | `database/migrations/` |
| Seeder du CSV | `database/seeders/CategorieSeeder.php`, fichier `database/data/categories.csv` |
| Modèles et relations | `app/Models/` (`User`, `Livre`, `Categorie`) |
| Contrôleurs | `app/Http/Controllers/` (`AuthController`, `GoogleController`, `Api/LivreController`) |
| Composants Livewire | `app/Livewire/` + vues dans `resources/views/livewire/` |
| Règle de validation ISBN | `app/Rules/Isbn.php` |
| Format JSON de l'API | `app/Http/Resources/LivreResource.php` |
| Layout et vues | `resources/views/layouts/app.blade.php`, `resources/views/` |
| JavaScript de la page API | `resources/js/page-api.js` |
| Routes | `routes/web.php`, `routes/api.php` |
