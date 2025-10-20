<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Airsoft',
                'description' => 'Réplicas de airsoft, accesorios y equipamiento táctico para juegos de simulación militar.',
                'icon' => '🎯',
            ],
            [
                'name' => 'Armamento Traumatico y Defensa',
                'description' => 'Armas traumáticas de defensa personal y equipamiento de seguridad.',
                'icon' => '🛡️',
            ],
            [
                'name' => 'Caza',
                'description' => 'Equipamiento y accesorios para actividades de caza deportiva.',
                'icon' => '🎯',
            ],
            [
                'name' => 'Accesorios',
                'description' => 'Accesorios tácticos, ópticas, linternas, láseres y más.',
                'icon' => '🔧',
                'subcategories' => [
                    'Bolsos y Mochilas',
                    'calcetas - cubre mangas',
                    'Calzado Táctico',
                    'Chalecos Tácticos Operativos',
                    'Chalecos y collar mascotas',
                    'Cinturones Operativos Tácticos',
                    'Equipo Táctico',
                    'Funda Pistola y Porta Cargadores',
                    'Gorros y Boonie',
                    'Guantes - Polainas - bufandas',
                    'lentes tacticos',
                    'Linternas Tácticas',
                    'municion postones  - c02',
                    'Parches',
                    'Pouches tacticos',
                    'Radios Tacticas Comunicacion',
                    'Regalos varios',
                    'Rodilleras',
                    'Vestuario Táctico',
                ],
            ],
            [
                'name' => 'Camping Trekking',
                'description' => 'Equipamiento para camping, trekking y actividades al aire libre.',
                'icon' => '⛺',
            ],
            [
                'name' => 'Guardias Seguridad',
                'description' => 'Equipamiento profesional para guardias de seguridad y vigilancia.',
                'icon' => '👮',
            ],
            [
                'name' => 'Tenidas y Calzado',
                'description' => 'Uniformes tácticos, ropa operativa y calzado especializado.',
                'icon' => '👕',
            ],
        ];

        foreach ($categories as $categoryData) {
            $parentCategory = Category::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'parent_id' => null,
            ]);

            // Crear subcategorías si existen
            if (isset($categoryData['subcategories'])) {
                foreach ($categoryData['subcategories'] as $subcategoryName) {
                    Category::create([
                        'name' => $subcategoryName,
                        'slug' => Str::slug($subcategoryName),
                        'description' => "Subcategoría de {$categoryData['name']}: {$subcategoryName}",
                        'parent_id' => $parentCategory->id,
                    ]);
                }
            }
        }

        $this->command->info('✅ Categorías creadas exitosamente!');
    }
}
