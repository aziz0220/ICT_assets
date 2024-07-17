<form action="{{ route('contents.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="body" placeholder="Body" required></textarea>
    <input type="file" name="file">
    <button type="submit">Create Content</button>
</form>
