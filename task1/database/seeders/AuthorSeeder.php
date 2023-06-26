<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Айболат Кулатай',
            'email' => 'example@example.com',
            'avatar' => 'avatar.png',
        ]);
        Author::create([
            'name' => 'Кобеев Спабек',
            'email' => 'kobeyevv@mail.ru',
            'avatar' => 'avatar.png',
        ]);
    }
}
