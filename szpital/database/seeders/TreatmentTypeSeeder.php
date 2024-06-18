<?php

namespace Database\Seeders;

use App\Models\TreatmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TreatmentType::truncate();
        TreatmentType::insert([
            [
                'name' => 'operacja jelita',
                'description' => 'operacja jelita',
                'recommendations_before_surgery' => 'zalecenia',
                'recommendations_after_surgery' => 'jedz oszczędnie'
            ],
            [
                'name' => 'operacja serca',
                'description' => 'operacja na otwartym sercu',
                'recommendations_before_surgery' => 'przygotowanie do operacji serca',
                'recommendations_after_surgery' => 'unikanie stresu i wysiłku fizycznego'
            ],
            [
                'name' => 'operacja kręgosłupa',
                'description' => 'zabieg na kręgosłupie',
                'recommendations_before_surgery' => 'ćwiczenia rozciągające, unikanie obciążeń',
                'recommendations_after_surgery' => 'rehabilitacja i ćwiczenia fizyczne'
            ],
            [
                'name' => 'operacja kolana',
                'description' => 'zabieg rekonstrukcji kolana',
                'recommendations_before_surgery' => 'przygotowanie do operacji kolana',
                'recommendations_after_surgery' => 'ćwiczenia rehabilitacyjne, unikanie nadmiernego obciążenia'
            ],
            [
                'name' => 'operacja wyrostka robaczkowego',
                'description' => 'usunięcie wyrostka robaczkowego',
                'recommendations_before_surgery' => 'pościć przez 8 godzin przed operacją',
                'recommendations_after_surgery' => 'jedz lekkostrawne pokarmy, unikanie wysiłku fizycznego'
            ],
            [
                'name' => 'operacja zaćmy',
                'description' => 'usunięcie zaćmy',
                'recommendations_before_surgery' => 'nie stosować makijażu, unikanie soczewek kontaktowych',
                'recommendations_after_surgery' => 'ochrona oczu, unikanie jasnego światła'
            ],
            [
                'name' => 'operacja plastyczna nosa',
                'description' => 'korekta nosa',
                'recommendations_before_surgery' => 'unikanie leków rozrzedzających krew',
                'recommendations_after_surgery' => 'unikanie urazów nosa, ograniczenie aktywności fizycznej'
            ]
        ]);
    }

}
