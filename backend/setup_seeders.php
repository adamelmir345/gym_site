<?php

$seeder = <<<EOD
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
        \$adminRole = Role::create(['name' => 'admin']);
        \$memberRole = Role::create(['name' => 'member']);

        // 2. Create Admin User
        \$admin = User::create([
            'name' => 'Admin FitNess',
            'email' => 'admin@fitness.ma',
            'password' => Hash::make('password'),
        ]);
        \$admin->assignRole(\$adminRole);

        // 3. Create Member User
        \$member = User::create([
            'name' => 'Member Test',
            'email' => 'member@fitness.ma',
            'password' => Hash::make('password'),
        ]);
        \$member->assignRole(\$memberRole);

        // 4. Coaches
        Coach::create([
            'name' => 'Amine',
            'specialty' => 'Musculation',
            'bio' => 'Expert en prise de masse',
            'instagram' => '@amine_coach'
        ]);

        Coach::create([
            'name' => 'Sara',
            'specialty' => 'Fitness & Cardio',
            'bio' => 'Spécialiste perte de poids',
            'instagram' => '@sara_fit'
        ]);

        // 5. Plans
        Plan::create([
            'name' => 'Basic',
            'price' => 199.00,
            'duration_in_days' => 30,
            'description' => 'Accès salle de musculation'
        ]);
        
        Plan::create([
            'name' => 'Premium',
            'price' => 299.00,
            'duration_in_days' => 30,
            'description' => 'Accès salle + cours collectifs + piscine'
        ]);

        // 6. Products
        \$cat1 = Category::create(['name' => 'Protéines', 'slug' => 'proteines']);
        \$cat2 = Category::create(['name' => 'Equipement', 'slug' => 'equipement']);

        Product::create([
            'category_id' => \$cat1->id,
            'name' => 'Whey Protein',
            'slug' => 'whey-protein',
            'description' => '100% Whey Gold Standard',
            'price' => 650.00,
            'stock' => 50
        ]);

        Product::create([
            'category_id' => \$cat2->id,
            'name' => 'Gants Musculation',
            'slug' => 'gants-muscu',
            'description' => 'Gants en cuir premium',
            'price' => 120.00,
            'stock' => 30
        ]);

        // 7. Locations
        Location::create([
            'name' => 'FitNess Casa',
            'address' => 'Maarif, Casablanca',
            'hours' => '06:00 - 23:00',
            'phone' => '0522001122'
        ]);
    }
}
EOD;

file_put_contents(__DIR__ . '/database/seeders/DatabaseSeeder.php', $seeder);

echo "Seeders setup complete.\n";
