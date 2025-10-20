<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Iniciando seeders de la base de datos...');
        
        // Crear usuario administrador
        $this->command->info('👤 Creando usuario administrador...');
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@armeria.cl',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Crear usuario de prueba
        User::create([
            'name' => 'Usuario Test',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Usuarios creados');

        // Ejecutar seeder de categorías
        $this->command->info('📂 Creando categorías...');
        $this->call(CategorySeeder::class);

        // Ejecutar seeder de productos
        $this->command->info('📦 Importando productos...');
        $this->call(ProductSeeder::class);

        $this->command->info('');
        $this->command->info('🎉 ¡Base de datos poblada exitosamente!');
        $this->command->info('');
        $this->command->info('📧 Credenciales de acceso:');
        $this->command->info('   Email: admin@armeria.cl');
        $this->command->info('   Password: password');
        $this->command->info('');
    }
}
