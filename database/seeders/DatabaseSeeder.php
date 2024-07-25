<?php

namespace Database\Seeders;

use App\Models\AdjacencyList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(?int $user = null): void
    {
        $lastCategoryAutoIncrement = DB::select("SELECT seq FROM sqlite_sequence WHERE name = 'adjacency_list_categories'")[0]->seq;

        AdjacencyList\Category::insert(
            array_map(
                fn (array $category) => [
                    ...$category,
                    'id' => $lastCategoryAutoIncrement + $category['id'],
                    'parent_id' => $category['parent_id'] ? $lastCategoryAutoIncrement + $category['parent_id'] : null,
                    'user_id' => $user,
                ],
                require storage_path('seeders/adjacency_list_categories.php'),
            )
        );
    }
}
