<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => 'フロントエンド'],
            ['category_name' => 'バックエンド'],
            ['category_name' => 'デザイン'],
            ['category_name' => 'ソフトウェア'],
            ['category_name' => 'ハードウェア'],
        ]);
    }
}
