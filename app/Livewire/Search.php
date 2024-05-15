<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\SearchBook;
use App\Models\UploadBook;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Search extends Component
{
    use WithFileUploads;

    public $uploadBooks;

    public $result_books = null;
    public $result_book = null;

    public $response_time;

    public bool $is_select_book_modal_open = false;
    public bool $is_results_book_modal_open = false;

    public $book_id;
    public $book_image;

    public function openSelectBookModal()
    {
        $this->result_books = null;
        $this->result_book = null;
        $this->is_select_book_modal_open = true;
        $this->is_results_book_modal_open = false;
    }

    public function openResultsBookModal()
    {
        $this->result_book = null;
        $this->is_select_book_modal_open = false;
        $this->is_results_book_modal_open = true;
    }

//    public function openDetailBookModal(string $book_image)
//    {
//        $this->is_results_book_modal_open = false;
//        $this->is_select_book_modal_open = false;
//
//        $image = str_replace('train_images/', '', $book_image);
//        $book = Book::where('image', $image)->first();
//        $this->result_book = $book;
//    }

    public function selectSearchBook(int $book_id)
    {
        try {

            $uploadBook = UploadBook::find($book_id);

            if(!$uploadBook){

            }

            $imagePath = storage_path('app/public/' . $uploadBook->image);

            if(File::exists($imagePath)){
                $image = File::get($imagePath);

                $start = microtime(true);
                $response = Http::attach('image', $image, 'image.jpg')->post('127.0.0.1:8000/user/books/search');
                $end = microtime(true);
                $response_time = $end - $start;

                if($response->successful()){
                    $datas = $response->json();
                    $searchBook = new SearchBook();
                    $searchBook->query_image_name = $uploadBook->image;
                    foreach($datas['data'] as $data){
                        $searchBook->book_1_percentage = $datas['data'][0][0] ?? null;
                        $searchBook->book_1_image_name = $datas['data'][0][1] ?? null;
                        $searchBook->book_2_percentage = $datas['data'][1][0] ?? null;
                        $searchBook->book_2_image_name = $datas['data'][1][1] ?? null;
                        $searchBook->book_3_percentage = $datas['data'][2][0] ?? null;
                        $searchBook->book_3_image_name = $datas['data'][2][1] ?? null;
                        $searchBook->book_4_percentage = $datas['data'][3][0] ?? null;
                        $searchBook->book_4_image_name = $datas['data'][3][1] ?? null;
                    }
                    $searchBook->type = 1;
                    $searchBook->response_time = $response_time;
                    $searchBook->save();

                    $this->result_books = $datas['data'];
                    $this->is_results_book_modal_open = true;
                    $this->is_select_book_modal_open = false;
                    $this->result_book = null;
                    $this->response_time = $response_time;


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

    #[Title('Search Book Cover')]
    public function render()
    {
        $this->uploadBooks = UploadBook::latest()->get();
        return view('livewire.search');
    }
}
