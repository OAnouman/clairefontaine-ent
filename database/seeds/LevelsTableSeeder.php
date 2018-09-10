<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Maternelle

        Level::create([
            'name' => 'TPS',
            'academic_grade' => 'Maternelle'
        ]);
        Level::create([
            'name' => 'PS',
            'academic_grade' => 'Maternelle'
        ]);
        Level::create([
            'name' => 'MS',
            'academic_grade' => 'Maternelle'
        ]);
        Level::create([
            'name' => 'GS',
            'academic_grade' => 'Maternelle'
        ]);

        //Primaire

        Level::create([
            'name' => 'CP',
            'academic_grade' => 'Primaire'
        ]);
        Level::create([
            'name' => 'CE1',
            'academic_grade' => 'Primaire'
        ]);
        Level::create([
            'name' => 'CE2',
            'academic_grade' => 'Primaire'
        ]);
        Level::create([
            'name' => 'CM1',
            'academic_grade' => 'Primaire'
        ]);
        Level::create([
            'name' => 'CM2',
            'academic_grade' => 'Primaire'
        ]);

        //Collège

        Level::create([
            'name' => '6ème',
            'academic_grade' => 'Secondaire'
        ]);
        Level::create([
            'name' => '5ème',
            'academic_grade' => 'Secondaire'
        ]);
        Level::create([
            'name' => '4ème',
            'academic_grade' => 'Secondaire'
        ]);
        Level::create([
            'name' => '3ème',
            'academic_grade' => 'Secondaire'
        ]);

        // Lycée

        Level::create([
            'name' => '2nd Générale',
            'academic_grade' => 'Secondaire'
        ]);
        Level::create([
            'name' => '1ère ES',
            'academic_grade' => 'Secondaire'
        ]);
        Level::create([
            'name' => '1ère S',
            'academic_grade' => 'Secondaire'
        ]);
        Level::create([
            'name' => '1ère L',
            'academic_grade' => 'Secondaire'
        ]);
        Level::create([
            'name' => '1ère STMG',
            'academic_grade' => 'Secondaire'
        ]);

        Level::create([
            'name' => 'Tle ES',
            'academic_grade' => 'Secondaire'
        ]);
        Level::create([
            'name' => 'Tle S',
            'academic_grade' => 'Secondaire'
        ]);
        Level::create([
            'name' => 'Tle L',
            'academic_grade' => 'Secondaire'
        ]);
        Level::create([
            'name' => 'Tle STMG',
            'academic_grade' => 'Secondaire'
        ]);
    }
}
