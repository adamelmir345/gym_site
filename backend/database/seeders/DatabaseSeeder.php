<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Coach;
use App\Models\Plan;
use App\Models\Category;
use App\Models\Product;
use App\Models\Location;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $memberRole = Role::firstOrCreate(['name' => 'member']);

        // 2. Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@fitness.ma'],
            ['name' => 'Admin FitNess', 'password' => Hash::make('password')]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

        // 3. Create Member User
        $member = User::firstOrCreate(
            ['email' => 'member@fitness.ma'],
            ['name' => 'Member Test', 'password' => Hash::make('password')]
        );
        if (!$member->hasRole('member')) {
            $member->assignRole($memberRole);
        }

        // 4. Coaches
        $coaches = [
            ['name' => 'Amine', 'specialty' => 'Musculation', 'bio' => 'Expert en prise de masse et force athlétique.', 'instagram' => '@amine_coach'],
            ['name' => 'Sara', 'specialty' => 'Fitness & Cardio', 'bio' => 'Spécialiste perte de poids et HIIT.', 'instagram' => '@sara_fit'],
            ['name' => 'Youssef', 'specialty' => 'CrossFit', 'bio' => 'Entraînement fonctionnel et haute intensité.', 'instagram' => '@youssef_crossfit'],
            ['name' => 'Leila', 'specialty' => 'Yoga & Pilates', 'bio' => 'Souplesse, mobilité et bien-être.', 'instagram' => '@leila_zen'],
            ['name' => 'Karim', 'specialty' => 'Boxe', 'bio' => 'Cardio boxing et self-défense.', 'instagram' => '@karim_boxing'],
        ];
        
        foreach ($coaches as $coach) {
            Coach::firstOrCreate(['name' => $coach['name']], $coach);
        }

        // 5. Plans
        $plans = [
            ['name' => 'Basic', 'price' => 199.00, 'duration_in_days' => 30, 'description' => 'Accès salle de musculation (Heures creuses)'],
            ['name' => 'Standard', 'price' => 249.00, 'duration_in_days' => 30, 'description' => 'Accès illimité salle de musculation'],
            ['name' => 'Premium', 'price' => 299.00, 'duration_in_days' => 30, 'description' => 'Accès salle + 2 cours collectifs par semaine'],
            ['name' => 'VIP', 'price' => 499.00, 'duration_in_days' => 30, 'description' => 'Accès illimité + tous les cours + piscine + sauna'],
            ['name' => 'Annuel VIP', 'price' => 4990.00, 'duration_in_days' => 365, 'description' => '2 mois offerts sur le pack VIP'],
        ];

        foreach ($plans as $plan) {
            Plan::firstOrCreate(['name' => $plan['name']], $plan);
        }

        // 6. Products & Categories
        $categories = [
            'Protéines' => 'proteines',
            'Equipement' => 'equipement',
            'Vêtements' => 'vetements',
            'Vitamines & Santé' => 'vitamines',
        ];

        $cats = [];
        foreach ($categories as $name => $slug) {
            $cats[$slug] = Category::firstOrCreate(['slug' => $slug], ['name' => $name]);
        }

        $products = [
            ['category_id' => $cats['proteines']->id, 'name' => 'Whey Protein Gold', 'slug' => 'whey-gold', 'description' => '100% Whey Gold Standard (2kg)', 'price' => 650.00, 'stock' => 50],
            ['category_id' => $cats['proteines']->id, 'name' => 'Mass Gainer', 'slug' => 'mass-gainer', 'description' => 'Gainer haute qualité (5kg) pour prise de masse rapide.', 'price' => 550.00, 'stock' => 25],
            ['category_id' => $cats['proteines']->id, 'name' => 'BCAA 2:1:1', 'slug' => 'bcaa', 'description' => 'Acides aminés essentiels pour la récupération.', 'price' => 250.00, 'stock' => 100],
            ['category_id' => $cats['vitamines']->id, 'name' => 'Pre-Workout Explosive', 'slug' => 'pre-workout', 'description' => 'Booster d\'énergie avant l\'entraînement.', 'price' => 300.00, 'stock' => 40],
            ['category_id' => $cats['vitamines']->id, 'name' => 'Omega 3', 'slug' => 'omega-3', 'description' => 'Huile de poisson pure, protection cardiovasculaire.', 'price' => 150.00, 'stock' => 60],
            ['category_id' => $cats['equipement']->id, 'name' => 'Gants Musculation', 'slug' => 'gants-muscu', 'description' => 'Gants en cuir premium avec renfort poignet.', 'price' => 120.00, 'stock' => 30],
            ['category_id' => $cats['equipement']->id, 'name' => 'Ceinture Lombaire', 'slug' => 'ceinture', 'description' => 'Ceinture de force pour squats et soulevés de terre.', 'price' => 199.00, 'stock' => 20],
            ['category_id' => $cats['equipement']->id, 'name' => 'Corde à sauter Pro', 'slug' => 'corde-pro', 'description' => 'Corde à sauter en acier avec roulements.', 'price' => 80.00, 'stock' => 80],
            ['category_id' => $cats['vetements']->id, 'name' => 'T-shirt Compression', 'slug' => 'tshirt-comp', 'description' => 'T-shirt respirant pour homme.', 'price' => 150.00, 'stock' => 45],
            ['category_id' => $cats['vetements']->id, 'name' => 'Legging Sport Femme', 'slug' => 'legging-femme', 'description' => 'Legging taille haute, anti-transpiration.', 'price' => 180.00, 'stock' => 50],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(['slug' => $product['slug']], $product);
        }

        // 7. Locations
        $locations = [
            ['name' => 'FitNess Maarif', 'address' => 'Bd Al Massira Al Khadra, Casablanca', 'hours' => '06:00 - 23:00', 'phone' => '0522001122'],
            ['name' => 'FitNess Ain Diab', 'address' => 'Boulevard de la Corniche, Casablanca', 'hours' => '06:00 - 23:00', 'phone' => '0522001133'],
            ['name' => 'FitNess Agdal', 'address' => 'Avenue Fal Ould Oumeir, Rabat', 'hours' => '06:00 - 22:30', 'phone' => '0537002244'],
            ['name' => 'FitNess Gueliz', 'address' => 'Avenue Mohammed V, Marrakech', 'hours' => '07:00 - 23:00', 'phone' => '0524003355'],
        ];

        foreach ($locations as $location) {
            Location::firstOrCreate(['name' => $location['name']], $location);
        }
    }
}