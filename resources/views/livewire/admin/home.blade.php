<div>
    <div class="container mt-4">
        <a href="{{route('admin.book.index')}}" wire:navigate>Books</a>
        <br>
        <a href="{{route('admin.logout')}}" wire:navigate>Logout</a>
        <br>
        Stats: <br>
        Total book: {{$total_book}}<br>
        Total search: {{$total_search}} <br>
        Average response time: {{$avg_response_time}} seconds <br>
        Average best match: {{round(($avg_match / 1000) * 100, 1)}}%
    </div>
</div>
