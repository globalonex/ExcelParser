<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ApiToken;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создайте пользователя
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => bcrypt(config('auth.basicPassword')),
        ]);

        // Генерируйте API ключ и привяжите его к пользователю
        $apiToken = ApiToken::create([
            'token' => ApiToken::generateToken(),
        ]);

        Log::info('Ваш токен: ' . $apiToken->token);

        $user->apiTokens()->attach($apiToken);
    }
}
