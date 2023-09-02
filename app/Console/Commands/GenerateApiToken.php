<?php

namespace App\Console\Commands;

use App\Models\ApiToken;
use App\Models\User;
use Illuminate\Console\Command;

class GenerateApiToken extends Command
{
    protected $signature = 'api-token:generate {user}';
    protected $description = 'Generate and display an API token for a user';

    /**
     * @return void
     * @throws \Exception
     * @message Made by Ismagilov Islam
     */
    public function handle()
    {
        $user = User::findOrFail($this->argument('user'));

        $token = ApiToken::create([
            'token' => bin2hex(random_bytes(32)),
        ]);

        $user->apiTokens()->attach($token);

        $this->info('API Token: ' . $token->token);
    }
}
