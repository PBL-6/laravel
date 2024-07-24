<?php

namespace App\Livewire\Admin\Book;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:225')]
    public string $title;
    #[Validate('required|string|max:225')]
    public string $category;
    #[Validate('required|boolean')]
    public bool $available;
    #[Validate('required|date')]
    public $published;
    #[Validate('required|image|max:10024')]
    public $image;

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


    public function mount()
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
                message: 'Internal server error.',
                success: false,
            );
        }
    }

    public function add_authors()
    {
        $this->authors[] = ['name' => ''];
    }

    public function delete_authors($index)
    {
        unset($this->authors[$index]);
        $this->authors = array_values($this->authors);
    }

    public function store()
    {
        $validated = $this->validate();

        try {

            if(count($this->authors) > 1){
                $author_names = array_column($this->authors, 'name');
                $combined_author_names = implode(' - ', $author_names);
            }else{
                $combined_author_names = $this->authors[0]['name'];
            }

            $temp_url = $this->image->temporaryUrl();
            $path_url = parse_url($temp_url, PHP_URL_PATH);
            $filename = basename($path_url);

            $imagePath = storage_path('app/livewire-tmp/' . $filename);

            if(File::exists($imagePath)) {
                $image = File::get($imagePath);

                $response = Http::attach('image', $image, 'image.jpg')
                    ->post(env('FAST_API_URL') . '/admin/books', [
                        'title' => $validated['title'],
                        'author' => $combined_author_names,
                        'category' => $validated['category'],
                        'available' => $validated['available'] == true ? 'true' : 'false',
                        'published_at' => $validated['published']
                    ]);

                if ($response->successful()) {
                    $this->dispatch('toast',
                        message: 'Add book success.',
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

    #[Title('Add Book')]
    #[Layout('components.layouts.app2')]
    public function render()
    {
        return view('livewire.admin.book.create');
    }
}
