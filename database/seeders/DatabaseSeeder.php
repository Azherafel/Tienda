<?php

namespace Database\Seeders;

use App\Models\cliente;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $cliente = new cliente();
        $cliente->nombre = 'Leonardo';
        $cliente->apellidoP = 'Sanchez';
        $cliente->apellidoM = 'Piñon';
        $cliente->telefono = '1234567890';
        $cliente->correo = 'leosanz@example.com';
        $cliente->save();

        $cliente = new cliente();
        $cliente->nombre = 'Gonzalo';
        $cliente->apellidoP = 'Martinez';
        $cliente->apellidoM = 'Rodriguez';
        $cliente->telefono = '0987654321';
        $cliente->correo = 'gonzamtz@example.com';
        $cliente->save();
    }
}
