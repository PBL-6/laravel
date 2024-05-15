<?php

namespace App\Livewire;

use App\Models\UploadBook;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{

    use WithFileUploads;

    public int $file_iteration = 0;

    #[Validate('required|image|max:2048')]
    public $image = null;

    public function saveUploadBook()
    {
        $this->validate();

        try {

            $image = $this->image->store('images/uploads', 'public');

            UploadBook::create([
                'image' => $image
            ]);

            $this->file_iteration++;
            $this->image = null;

            $this->dispatch('toast',
                message: 'Upload book cover success.',
                success: true,
            );

        }catch (\Exception $e){
            $this->dispatch('toast',
                message: $e->getMessage(),
                success: false,
            );
        }
    }

    #[Title('Upload Book Cover')]
    public function render()
    {
        return view('livewire.upload');
    }
}
