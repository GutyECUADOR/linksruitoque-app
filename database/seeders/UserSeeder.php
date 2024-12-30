<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        );

        $cliente = Cliente::create([
            'tipoDocumentoIdentidad' => 'cedula',
            'numeroDocumentoIdentidad' => '1600505505',
            'nombre' => 'Gutiérrez R. José',
            'telefonoContacto' => '+593999887766',
            'email' => 'gutiecuador@gmail.com',
            'direccionCorrespondencia' => 'Direccion de pruebas',
        ]);

        Invoice::create([
            'cliente_id' => $cliente->id,
            'numeroFactura' => '001',
            'referenciaPago' => 'pruebas',
            'valor' => 10,
            'valorVencido' => 12,
            'periodoCancelar' => 'Del 20 de junio al 20 de agosto',
            'fechaLimitePago' => Carbon::now()->format('Y-m-d')
        ]);

        Invoice::create([
            'cliente_id' => $cliente->id,
            'numeroFactura' => '002',
            'referenciaPago' => 'pruebas',
            'valor' => 20,
            'valorVencido' => 22,
            'periodoCancelar' => 'Del 20 de junio al 20 de agosto',
            'fechaLimitePago' => Carbon::now()->format('Y-m-d')
        ]);



    }
}
