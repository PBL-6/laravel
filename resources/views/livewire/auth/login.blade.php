<div>
    <div class="container">
        <form wire:submit="login" class="mt-4">
            <input type="text" wire:model.blur="email" placeholder="email">
            @error('email')
                {{$message}}
            @enderror
            <input type="password" wire:model.blur="password" placeholder="password">
            @error('password')
                {{$message}}
            @enderror
            <button type="submit">Login</button>
        </form>
    </div>
</div>
