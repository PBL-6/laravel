<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|email|max:25')]
    public string $email;

    #[Validate('required|string|max:25')]
    public string $password;

    public function login()
    {
        $validated = $this->validate();

        try {
            if (auth()->attempt([
                'email' => $validated['email'],
                'password' => $validated['password'],
            ], true)) {
                $this->redirectRoute('admin.home', navigate: true);
            } else {
                $this->dispatch('toast',
                    message: 'Email or password is wrong.',
                    success: false,
                );
            }
        } catch (\Exception $e) {
            $this->dispatch('toast',
                message: 'Internal server error.',
                success: false,
            );
        }
    }

    #[Title('Login')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
