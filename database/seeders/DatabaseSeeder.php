public function run(): void
{
    $this->call([
        DepartamentoSeeder::class,
        UsuarioSeeder::class,
        EquipoSeeder::class,
        BajaSeeder::class,
    ]);

    // Si quieres dejar este ejemplo de usuario de prueba
    \App\Models\User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);
}
