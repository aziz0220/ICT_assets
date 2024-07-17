@foreach($forums as $forum)
    <div>
        <h2>{{ $forum->title }}</h2>
        <p>{{ $forum->description }}</p>
        <a href="{{ route('forums.show', $forum) }}">View</a>
    </div>
@endforeach
