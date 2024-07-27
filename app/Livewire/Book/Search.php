<?php

namespace App\Livewire\Book;

use App\Models\SearchBook;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Search extends Component
{
    use WithFileUploads;

    public bool $isUpload = false;

    public bool $isNotFound = false;

    public string $query_image_name = '';

    #[Validate('required|image|max:5242')]
    public $image = null;

    public function toggleUpload()
    {
        $this->isNotFound = false;
        $this->isUpload = true;
    }

    public function toggleResult()
    {
        $this->isUpload = false;
    }

    public function search()
    {
        $this->validate();

        try {

            $temp_url = $this->image->temporaryUrl();
            $path_url = parse_url($temp_url, PHP_URL_PATH);
            $filename = basename($path_url);

            $imagePath = storage_path('app/livewire-tmp/' . $filename);

            if(File::exists($imagePath)) {
                $image = File::get($imagePath);

                $response1 = Http::attach('image', $image, 'image.jpg')->post('127.0.0.1:8000/user/books/upload');

                if($response1->successful()) {

                    $data1 = $response1->json();
                    $image_name = $data1['data'];

                    $start = microtime(true);
                    $response2 = Http::asForm()->post(env('FAST_API_URL') . '/user/books/search',
                        ['image_name' => $image_name]
                    );

                    $end = microtime(true);
                    $response_time = $end - $start;

                    if($response2->successful()){
                        $data2 = $response2->json();

                        $searchBook = new SearchBook();
                        $searchBook->query_image = $image_name;

                        if($data2['data'] == null){
                            $this->isNotFound = true;
                            $this->image = null;

                            $this->query_image_name = $image_name;
                            $this->toggleResult();
                        }else{
                                $searchBook->book_1_match = $data2['data'][0][0] ?? null;
                                $searchBook->book_1_image = $data2['data'][0][1] ?? null;
                                $searchBook->book_2_match = $data2['data'][1][0] ?? null;
                                $searchBook->book_2_image = $data2['data'][1][1] ?? null;
                                $searchBook->book_3_match = $data2['data'][2][0] ?? null;
                                $searchBook->book_3_image = $data2['data'][2][1] ?? null;
                                $searchBook->book_4_match = $data2['data'][3][0] ?? null;
                                $searchBook->book_4_image = $data2['data'][3][1] ?? null;

                            $searchBook->response_time = $response_time;
                            $searchBook->save();

                            $this->redirect(route('search.result', $searchBook->id));
                        }

                    }else if($response2->clientError()){
                        $this->dispatch('toast',
                            message: 'Validation error.',
                            success: false,
                        );
                    }else if($response2->serverError()){
                        $this->dispatch('toast',
                            message: 'Internal server error.',
                            success: false,
                        );
                    }

                }else if($response1->clientError()){
                    $this->dispatch('toast',
                        message: 'Validation error.',
                        success: false,
                    );
                }else if($response1->serverError()){
                    $this->dispatch('toast',
                        message: 'Internal server error.',
                        success: false,
                    );
                }

            }else{
                $this->dispatch('toast',
                    message: 'Internal server error.',
                    success: false,
                );
            }

        }catch (\Exception $e){
            $this->dispatch('toast',
                message: 'Internal server error.',
                success: false,
            );
        }
    }

    #[Title('Search Book')]
    public function render()
    {
        return view('livewire.book.search');
    }
}
