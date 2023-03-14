<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ModuloSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SucursalesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProveedoresSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(MarcasSeeder::class);
        $this->call(UnidadMedidasSeeder::class);
        $this->call(MaterialesSeeder::class);
        $this->call(TipoClientesSeeder::class);
        $this->call(ClientesSeeder::class);
        $this->call(DireccionesEntregasSeeder::class);
        $this->call(ConfiguracionesSeeder::class);
        $this->call(AlmacenesSeeder::class);
        $this->call(ProductosSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
