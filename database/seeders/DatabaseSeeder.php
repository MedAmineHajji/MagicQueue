<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            "username" => 'root',
            "password" => 'toor'
        ]);

        \App\Models\User::create([
            "username" => 'Amine@root',
            "password" => 'toor'
        ]);

//creating a Template and inserting it into DB
        \App\Models\Template::create([
            "name" => 'templateDB1',
            "path" => 'C:/documents/djamine',
            'dimension_id' => 2,
            'logo_id' => null
        ]);

//Creating multiple elements and inserting them into DB
        $elements = [
            [
                'identifier' => 'logo-institution',
                'class' => 'auto-sized-diveeee',
                "style" => 'left: 0px; top: 0px;',
                "content" => '<span style="color: rgb(224, 62, 45);">
                            <strong>CNRPS Arianaa</strong>
                            </span>',
                "template_id" => 1,
                "hidden" => false
            ],
            [
                'identifier' => 'welcome-message',
                'class' => 'auto-sized-div',
                "style" => 'left: 0px; top: 0px;',
                "content" => '<span style="font-size: 10pt;">17-07-2023</span>',
                "template_id" => 1,
                "hidden" => false
            ],
            [
                'identifier' => 'khadamet',
                'class' => 'auto-sized-div',
                "style" => 'left: 0px; top: 0px;',
                "content" => '<span style="font-size: 36pt;">
                                <span style="font-family: "courier new", courier, monospace;">
                                    <span style="font-size: 10pt;">خدمات&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                        <span style="font-size: 36pt;">&nbsp;
                                        </span>
                                    </span>
                                </span>
                                B - 100
                            </span>',
                "template_id" => 1,
                "hidden" => false
            ],
            [
                'identifier' => 'date-time',
                'class' => 'auto-sized-div',
                "style" => 'left: 0px; top: 0px;',
                "content" => '<span style="font-size: 10pt;">
                                17-07-2023
                            </span>',
                "template_id" => 1,
                "hidden" => false
            ]
        ];
        foreach ($elements as $elementData) {
            DB::table('elements')->insert($elementData);
        }

//Creating multiple dimensions and inserting them into DB
        $dimensions = [
            [
                'name' => 'dimension 1',
                'width' => 120,
                "height" => 200
            ],
            [
                'name' => 'dimension 2',
                'width' => 140,
                "height" => 220
            ],
            [
                'name' => 'dimension 3',
                'width' => 360,
                "height" => 260
            ],
        ];
        foreach ($dimensions as $dimension) {
            DB::table('dimensions')->insert($dimension);
        }

//Creating single logo 
        $logo = [
            'file_name' => 'logo 1', 
            'file_path' => 'C:\xampp\htdocs\MagicQueueDev\storage\app\uploads\logo\1694207064_Resume_template (2).pdf',
            'identifier' => 'first-logo',
            'style' => 'left: 0px; top: 0px;'
        ];
        \App\Models\Logo::create($logo);
    }
}
