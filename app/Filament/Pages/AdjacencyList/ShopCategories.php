<?php

namespace App\Filament\Pages\AdjacencyList;

use App\Models\AdjacencyList\Category;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Livewire\Attributes\Locked;
use Saade\FilamentAdjacencyList\Forms\Components\AdjacencyList;

class ShopCategories extends Page
{
    protected static ?string $navigationGroup = 'saade/filament-adjacency-list';

    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';

    protected static string $view = 'filament.pages.form';

    #[Locked]
    public ?Category $record = null;

    public array $data = [];

    public function mount(): void
    {
        $this->record = Category::first();

        $this->form->fill(
            $this->record?->attributesToArray() ?? []
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                AdjacencyList::make('descendantsAndSelf')
                    ->label('Categories')
                    ->labelKey('name')
                    ->relationship()
                    ->rulers(),
            ])
            ->model($this->record)
            ->statePath('data');
    }
}
