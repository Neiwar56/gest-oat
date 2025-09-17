<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Localite;
use App\Models\Eglise;
use App\Models\Personne;
use App\Models\User;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Créer des localités
        $localites = [
            ['nom' => 'Douala'],
            ['nom' => 'Yaoundé'],
            ['nom' => 'Bafoussam'],
            ['nom' => 'Bamenda'],
            ['nom' => 'Garoua'],
        ];
        
        foreach ($localites as $localite) {
            Localite::firstOrCreate($localite);
        }

        // Créer des églises
        $eglise1 = Eglise::firstOrCreate(
            ['nom' => 'Église Baptiste de Douala'],
            ['localite_id' => 1]
        );
        
        $eglise2 = Eglise::firstOrCreate(
            ['nom' => 'Église Presbytérienne de Yaoundé'],
            ['localite_id' => 2]
        );
        
        $eglise3 = Eglise::firstOrCreate(
            ['nom' => 'Église Méthodiste de Bafoussam'],
            ['localite_id' => 3]
        );
        
        $eglise4 = Eglise::firstOrCreate(
            ['nom' => 'Église Pentecôtiste de Bamenda'],
            ['localite_id' => 4]
        );
        
        $eglise5 = Eglise::firstOrCreate(
            ['nom' => 'Église Adventiste de Garoua'],
            ['localite_id' => 5]
        );

        // Créer un admin simple pour les tests
        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin Test',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
        );

        // Créer quelques personnes de test
        Personne::firstOrCreate(
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'telephone' => '675123456'
            ],
            [
                'date_naissance' => '1990-05-15',
                'lieu_naissance' => 'Douala',
                'sexe' => 'Masculin',
                'situation_matrimoniale' => 'Célibataire',
                'profession' => 'Ingénieur',
                'adresse_exacte' => 'Quartier Akwa, Douala',
                'nationalite' => 'Camerounaise',
                'email' => 'jean.dupont@email.com',
                'localite_id' => 1,
                'eglise_id' => $eglise1->id,
                'admin_createur_id' => $admin->id,
            ]
        );

        Personne::firstOrCreate(
            [
                'nom' => 'Martin',
                'prenom' => 'Marie',
                'telephone' => '675987654'
            ],
            [
                'date_naissance' => '1985-08-22',
                'lieu_naissance' => 'Yaoundé',
                'sexe' => 'Féminin',
                'situation_matrimoniale' => 'Marié(e)',
                'profession' => 'Enseignante',
                'adresse_exacte' => 'Quartier Mfoundi, Yaoundé',
                'nationalite' => 'Camerounaise',
                'email' => 'marie.martin@email.com',
                'localite_id' => 2,
                'eglise_id' => $eglise2->id,
                'admin_createur_id' => $admin->id,
            ]
        );
    }
}
