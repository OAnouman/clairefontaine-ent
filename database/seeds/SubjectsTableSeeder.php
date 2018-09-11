<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Littéraire
        Subject::create([
            'name' => 'Anglais',
            'category' => 'Littéraire'
        ]);
        Subject::create([
            'name' => 'Français',
            'category' => 'Littéraire'
        ]);
        Subject::create([
            'name' => 'Espagnol',
            'category' => 'Littéraire'
        ]);
        Subject::create([
            'name' => 'Allemand',
            'category' => 'Littéraire'
        ]);
        Subject::create([
            'name' => 'Histoire-Géographie',
            'category' => 'Littéraire'
        ]);

        //Artistique

        Subject::create([
            'name' => 'Arts Plastiques',
            'category' => 'Artistique'
        ]);
        Subject::create([
            'name' => 'Musique',
            'category' => 'Artistique'
        ]);

        // Scientifique

        Subject::create([
            'name' => 'Mathématiques',
            'category' => 'Scientifique'
        ]);
        Subject::create([
            'name' => 'Sciences de la Vie et de la Terre',
            'category' => 'Scientifique'
        ]);
        Subject::create([
            'name' => 'Physique-Chimie',
            'category' => 'Scientifique'
        ]);
        Subject::create([
            'name' => 'Sciences Economiques et Sociales',
            'category' => 'Scientifique'
        ]);
        Subject::create([
            'name' => 'Santé et Sociale',
            'category' => 'Scientifique'
        ]);
    }
}
