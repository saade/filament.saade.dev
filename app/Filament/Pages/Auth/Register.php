<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Support\Facades\Artisan;
use Livewire\Attributes\Locked;

class Register extends BaseRegister
{
    protected ?string $subheading = 'We\'ve created a random account just for you, so you can mess around without affecting other users.';

    #[Locked]
    public ?User $record = null;

    #[Locked]
    public ?string $password = null;

    public function mount(): void
    {
        $this->password = fake()->password(8);

        parent::mount();
    }

    protected function getNameFormComponent(): Component
    {
        return parent::getNameFormComponent()
            ->readonly()
            ->default(fake()->name());
    }

    protected function getEmailFormComponent(): Component
    {
        return parent::getEmailFormComponent()
            ->readonly()
            ->default(fake()->unique()->safeEmail());
    }

    protected function getPasswordFormComponent(): Component
    {
        return parent::getPasswordFormComponent()
            ->readonly()
            ->default($this->password);
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return parent::getPasswordConfirmationFormComponent()
            ->readonly()
            ->default($this->password);
    }

    public function getRegisterFormAction(): Action
    {
        return parent::getRegisterFormAction()
            ->label('Sign up with a random account');
    }

    protected function handleRegistration(array $data): User
    {
        return $this->record = parent::handleRegistration($data);
    }

    public function afterRegister(): void
    {
        Artisan::call('app:seed-fresh-data', ['user' => $this->record->id]);
    }
}
