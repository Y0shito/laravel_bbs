<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()->count(50)->create();
    }
}
