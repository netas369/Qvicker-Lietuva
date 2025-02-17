<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Home Maintenance & Cleaning',
                'subcategories' => [
                    ['name' => 'Namų valymas'],
                    ['name' => 'Generalinis valymas'],
                    ['name' => 'Kilimų valymas'],
                    ['name' => 'Langų plovimas'],
                    ['name' => 'Latakų valymas'],
                    ['name' => 'Kenksmingų organizmų kontrolė'],
                    ['name' => 'Šiukšlių išvežimas'],
                ],
            ],
            [
                'name' => 'Gardening & Outdoor Services',
                'subcategories' => [
                    ['name' => 'Vejos pjovimas'],
                    ['name' => 'Sodininkystė ir apželdinimas'],
                    ['name' => 'Medžių genėjimas'],
                    ['name' => 'Sniego valymas'],
                ],
            ],
            [
                'name' => 'Handyman & Repairs',
                'subcategories' => [
                    ['name' => 'Dažymo ir dekoravimo paslaugos'],
                    ['name' => 'Santechnikos paslaugos'],
                    ['name' => 'Elektriko paslaugos'],
                    ['name' => 'Staliaus darbai'],
                    ['name' => 'Meistro paslaugos'],
                    ['name' => 'Stogo remonto pagalba'],
                ],
            ],
            [
                'name' => 'Moving & Packing Services',
                'subcategories' => [
                    ['name' => 'Perkraustymas ir pakavimas'],
                    ['name' => 'Organizavimas perkraustymui'],
                ],
            ],
            [
                'name' => 'Pet Care',
                'subcategories' => [
                    ['name' => 'Šunų vedžiojimas'],
                    ['name' => 'Gyvūnų priežiūra'],
                ],
            ],
            [
                'name' => 'Delivery & Transportation',
                'subcategories' => [
                    ['name' => 'Pristatymo paslaugos'],
                    ['name' => 'Vairavimo paslaugos'],
                ],
            ],
            [
                'name' => 'Fitness & Wellness',
                'subcategories' => [
                    ['name' => 'Asmeninis treneris'],
                    ['name' => 'Joga'],
                    ['name' => 'Masažo terapija'],
                    ['name' => 'Aitvarų sporto mokymai'],
                ],
            ],
            [
                'name' => 'Event Support',
                'subcategories' => [
                    ['name' => 'Pagalba renginiuose'],
                    ['name' => 'Aptarnavimas renginiuose'],
                    ['name' => 'Apsaugos paslaugos'],
                    ['name' => 'Padėjėjai maitinimui'],
                    ['name' => 'Barmenai'],
                    ['name' => 'Someljė paslaugos'],
                    ['name' => 'Didžėjaus paslaugos'],
                    ['name' => 'Pramogų paslaugos'],
                ],
            ],
            [
                'name' => 'Food & Beverage',
                'subcategories' => [
                    ['name' => 'Asmeninis šefas'],
                    ['name' => 'Barmenai'],
                    ['name' => 'Someljė paslaugos'],
                ],
            ],
            [
                'name' => 'Creative & Media Services',
                'subcategories' => [
                    ['name' => 'Fotografija'],
                    ['name' => 'Vaizdo įrašymas'],
                    ['name' => 'Didžėjaus paslaugos'],
                    ['name' => 'Pramogų paslaugos'],
                ],
            ],
            [
                'name' => 'Tourism & Guidance',
                'subcategories' => [
                    ['name' => 'Gido paslaugos'],
                    ['name' => 'Vertėjas'],
                ],
            ],
            [
                'name' => 'IT & Technical Support',
                'subcategories' => [
                    ['name' => 'IT pagalba (vietoje)'],
                ],
            ],
        ];

        // Insert categories and subcategories
        foreach ($categories as $category) {
            foreach ($category['subcategories'] as $subcategory) {
                DB::table('categories')->insert([
                    'category' => $category['name'],
                    'subcategory' => $subcategory['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
