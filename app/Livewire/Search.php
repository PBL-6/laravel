<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\UploadBook;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Search extends Component
{
    use WithFileUploads;

    public int $file_iteration = 0;

    #[Validate('required|image|max:2048')]
    public $image;

    public $uploadBooks;

    public $result_books;

    public $book_id;
    public $book_image;

    public function saveUploadBook()
    {
        $this->validate();

        try {

            $image = $this->image->store('images/uploads', 'public');

            UploadBook::create([
                'image' => $image
            ]);

            $this->file_iteration++;
            $this->reset('image');

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

    public function selectSearchBook(int $book_id)
    {
        try {

            $uploadBook = UploadBook::find($book_id);

            if(!$uploadBook){

            }

            $imagePath = storage_path('app/public/' . $uploadBook->image);

            if(File::exists($imagePath)){
                $image = File::get($imagePath);
                $response = Http::attach('image', $image, 'image.jpg')->post('127.0.0.1:8000/user/books/search');

                if($response->successful()){
                    $datas = $response->json();
                    $this->result_books = $datas['data'];
                }else if($response->clientError()){

                }else if($response->serverError()){

                }
            }else{
                $this->dispatch('toast',
                    message: 'Something wrong, please try again later.',
                    success: false,
                );
            }

        }catch (\Exception $e){
            $this->dispatch('toast',
                message: $e->getMessage(),
                success: false,
            );
        }
    }

    public function takeSearchBook()
    {
        try {

            $path = $this->image->store('images/search', 'public');
            $imagePath = storage_path('app/public/' . $path);

            if(File::exists($imagePath)){
                $image = File::get($imagePath);
                $response = Http::attach('image', $image, 'image.jpg')->post('127.0.0.1:8000/user/books/search');

                if($response->successful()){
                    $data = $response->json();
                    dd($data);
                }else if($response->clientError()){

                }else if($response->serverError()){

                }
            }else{

            }

        }catch (\Exception $e){
            $this->dispatch('toast',
                message: $e->getMessage(),
                success: false,
            );
        }
    }

    public function render()
    {
        $this->uploadBooks = UploadBook::latest()->get();
        return view('livewire.search');
    }
}
