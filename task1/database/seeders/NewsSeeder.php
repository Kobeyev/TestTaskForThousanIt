<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\News;
use App\Models\Category;
class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = Author::first();
        $categories = Category::pluck('id');

        News::create([
            'title' => 'Месси перешел в Интер Майами',
            'excerpt' => 'Шок Месси не выбрал Барселону',
            'content' => '36 летний звезда, легенда футбола, в закат карьеры перешел в Интер Майами США и бла бла',
            'published_at' => now(),
            'author_id' => $author->id,
        ])->categories()->attach($categories->random());

        News::create([
            'title' => 'Криштиану Роналду хочет вернуться в Европу',
            'excerpt' => 'Есть вероятность что Роналду вернется',
            'content' => 'В контракте Роналду с Аль-Насром есть пункт о том что Роналду может перейти в NEWCASTLE UNITED если они попадут в топ 4  АПЛ',
            'published_at' => now(),
            'author_id' => $author->id,
        ])->categories()->attach($categories->random());
    }
}
