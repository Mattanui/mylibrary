<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chemin = database_path('data/categories.csv');
        $fichier = fopen($chemin, 'r');

        fgetcsv($fichier, null, ';', '"', '');

        while (($ligne = fgetcsv($fichier, null, ';', '"', '')) !== false) {
            $nom = mb_ucfirst(mb_strtolower(trim($ligne[0])));

            if ($nom === '') {
                continue;
            }

            Categorie::firstOrCreate(['nom' => $nom]);
        }

        fclose($fichier);

        //
    }
}
