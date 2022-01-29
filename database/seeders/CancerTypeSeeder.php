<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CancerType;

class CancerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cancerTypeArray = [ [
            'cancer_name' => 'Skin Cancer',
        ],
        [
            'cancer_name' => 'Lung Cancer',
        ],
        [
            'cancer_name' => 'Prostate Cancer',
        ],
        [
            'cancer_name' => 'Breast Cancer',
        ],
        [
            'cancer_name' => 'Colorectal Cancer',
        ],
        [
            'cancer_name' => 'Kidney (renal) cancer',
        ],
        [
            'cancer_name' => 'Bladder Cancer',
        ] ];
        CancerType::insert($cancerTypeArray);

    }
}
