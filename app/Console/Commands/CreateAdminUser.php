<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-admin-user {--name=} {--email=} {--password=} {--personnel_number=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает пользователя с правами администратора';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->option('name');
        $email = $this->option('email');
        $password = $this->option('password');
        $personnelNumber = $this->option('personnel_number');

        if (empty($name) || empty($email) || empty($password) || empty($personnelNumber)) {
            $this->error('Введите все данные для регистрации админа: name, email, password, personnel_number');
            return Command::INVALID;
        }
        $existEmailUser = User::where('email', $email)->first();
        if (isset($existEmailUser)) {
            $this->error('Пользователь с таким email уже существует');
            return Command::INVALID;
        }

        $credentials  = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'personnel_number' => $personnelNumber,
        ];

        $user = User::create($credentials);

        $user->assignRole('admin');

        return Command::SUCCESS;
    }
}
