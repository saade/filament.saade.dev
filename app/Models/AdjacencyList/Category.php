<?php

namespace App\Models\AdjacencyList;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

#[ScopedBy(UserScope::class)]
class Category extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;

    protected $table = 'adjacency_list_categories';

    protected $fillable = ['name', 'parent_id', 'sort_order'];

    public $translatable = ['name'];
}
