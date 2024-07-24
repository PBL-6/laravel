<?php

namespace App\Livewire\Admin\Book;

use App\Models\Book;
use App\Models\SearchBook;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $id;

    #[Validate('required|string|max:225')]
    public string $title;
    #[Validate('required|string|max:225')]
    public string $category;
    #[Validate('required|boolean')]
    public string $available;
    #[Validate('required|date')]
    public $published;
    #[Validate('nullable|image|max:2048')]
    public $image;

    public $prev_image;

    public $authors = [];

    protected $rules = [
        'authors.*.name' => 'required|string|max:225'
    ];

    public function messages()
    {
        return [
            'authors.*.name.required' => 'The author field is required',
            'authors.*.name.string' => 'The author field must be string',
            'authors.*.name.max:225' => 'The author field is too long',
        ];
    }

    public function mount(int $id)
    {
        $book = Book::find($id);
        $this->id = $book->id;
        $this->title = $book->title;
        $this->category = $book->category;
        $this->published = $book->published_at;
        $this->available = $book->is_available;
        $this->prev_image = $book->image;

        $authors = explode(' - ', $book->author);
        if(count($authors) > 1){
            foreach($authors as $author){
                $this->authors[] = ['name' => $author];
            }
        }else{
            $this->authors[] = ['name' => $authors[0]];
        }
    }

    public function add_authors()
    {
        $this->authors[] = ['name' => ''];
    }

    public function generateCategory()
    {
        $validated = $this->validateOnly('title');

        try {

            $response = Http::asForm()->post(env('FAST_API_URL') . '/admin/books/category', [
                'title' => $validated['title']
            ]);

            if($response->successful()){
                $data = $response->json();
                $this->category = $data['data'];
            }else if($response->clientError()){
                $this->dispatch('toast',
                    message: 'Validation error.',
                    success: false,
                );
            }else if($response->serverError()){
                $this->dispatch('toast',
                    message: 'Internal server error.',
                    success: false,
                );
            }

        }catch (\Exception $e){
            $this->dispatch('toast',
                message: 'Internal server error',
                success: false,
            );
        }
    }

    public function delete_authors($index)
    {
        unset($this->authors[$index]);
        $this->authors = array_values($this->authors);
    }

    public function update()
    {
        $validated = $this->validate();

        try {

            if(count($this->authors) > 1){
                $author_names = array_column($this->authors, 'name');
                $combined_author_names = implode(' - ', $author_names);
            }else{
                $combined_author_names = $this->authors[0]['name'];
            }

            if($this->image){
                $temp_url = $this->image->temporaryUrl();
                $path_url = parse_url($temp_url, PHP_URL_PATH);
                $filename = basename($path_url);

                $imagePath = storage_path('app/livewire-tmp/' . $filename);

                if(File::exists($imagePath)) {
                    $image = File::get($imagePath);

                    $response = Http::attach('image', $image, 'image.jpg')
                        ->put(env('FAST_API_URL') . '/admin/books/' . $this->id, [
                            'title' => $validated['title'],
                            'author' => $combined_author_names,
                            'category' => $validated['category'],
                            'available' => $validated['available'],
                            'published_at' => $validated['published']
                        ]);

                    if ($response->successful()) {
                        $this->dispatch('toast',
                            message: 'Edit book success.',
                            success: true,
                        );
                        $this->redirectRoute('admin.book.index', navigate: true);
                    }else if($response->clientError()){
                        $this->dispatch('toast',
                            message: 'Validation error.',
                            success: false,
                        );
                    }else if($response->serverError()){
                        $this->dispatch('toast',
                            message: 'Internal server error.',
                            success: false,
                        );
                    }
                }
            }else{

                $response = Http::asForm()->put(env('FAST_API_URL') . '/admin/books/' . $this->id, [
                        'title' => $validated['title'],
                        'author' => $combined_author_names,
                        'category' => $validated['category'],
                        'available' => $validated['available'],
                        'published_at' => $validated['published']
                    ]);

                if ($response->successful()) {
                    $this->dispatch('toast',
                        message: 'Edit book success.',
                        success: true,
                    );
                    $this->redirectRoute('admin.book.index', navigate: true);
                }else if($response->clientError()){
                    $this->dispatch('toast',
                        message: 'Validation error.',
                        success: false,
                    );
                }else if($response->serverError()){
                    $this->dispatch('toast',
                        message: 'Internal server error.',
                        success: false,
                    );
                }
            }

        }catch (\Exception $e){
            $this->dispatch('toast',
                message: 'Internal server error.',
                success: false,
            );
        }
    }

    public function deleteBook()
    {
        try {

            $response = Http::delete(env('FAST_API_URL') . '/admin/books/' . $this->id);

            if ($response->successful()) {

                SearchBook::where('book_1_image', $this->prev_image)->delete();

                $this->dispatch('toast',
                    message: 'Delete book success.',
                    success: true,
                );

                $this->redirectRoute('admin.book.index', navigate: true);

            }else if($response->clientError()){
                $this->dispatch('toast',
                    message: 'Validation error.',
                    success: false,
                );
            }else if($response->serverError()){
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

    #[Title('Edit Book')]
    #[Layout('components.layouts.app2')]
    public function render()
    {
        return view('livewire.admin.book.edit');
    }
}
