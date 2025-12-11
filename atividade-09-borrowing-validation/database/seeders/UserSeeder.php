<?php


namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuário Admin Fixo
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'), // Senha padrão para testes
            'role' => 'admin',
        ]);


        // Usuário Bibliotecário Fixo
        User::create([
            'name' => 'Bibliotecário Chefe',
            'email' => 'biblio@library.com',
            'password' => Hash::make('password'),
            'role' => 'bibliotecario',
        ]);


        // Usuário Cliente Fixo
        User::create([
            'name' => 'Cliente Padrão',
            'email' => 'cliente@library.com',
            'password' => Hash::make('password'),
            'role' => 'cliente',
        ]);


        // Criação de usuários aleatórios usando a Factory
        // Cria 5 clientes e 2 bibliotecários extras
        User::factory(5)->create();
        User::factory(2)->bibliotecario()->create();
    }
}