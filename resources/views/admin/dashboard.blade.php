<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        button{
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="container">
    <h1 class="mb-4">Admin Movie Dashboard</h1>

    <!-- Search Form -->
    <form action="{{ route('admin.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search movies by title">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    <form action={{route("admin.logout")}}>
        <button>logout</button>
    </form>

    <!-- Success / Error Alerts -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Movie Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Thumbnail</th>
                <th>Title</th>
                <th>Description</th>
                <th>Production Year</th>
                <th>Duration</th>
                <th>Genre</th>
                <th>Synopsis</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movies as $movie)
                <tr>
                    <td><img src="{{ $movie->thumbnail }}" alt="Thumbnail" width="80"></td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->description }}</td>
                    <td>{{ $movie->production_year }}</td>
                    <td>{{ $movie->duration }}</td>
                    <td>{{ $movie->genre }}</td>
                    <td>{{ $movie->synopsis }}</td>
                    <td>
                        <form action="{{ route('admin.delete', $movie->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this movie?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No movies found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- Add Movie Form -->
    <h3 class="mt-5">Add New Movie</h3>
    <form action="{{ route('admin.add') }}" method="POST">
        @csrf
        <div class="mb-2">
            <input type="text" name="title" class="form-control" placeholder="Title" required>
        </div>
        <div class="mb-2">
            <input type="text" name="thumbnail" class="form-control" placeholder="Thumbnail URL" required>
        </div>
        <div class="mb-2">
            <textarea name="description" class="form-control" placeholder="Description" required></textarea>
        </div>
        <div class="mb-2">
            <input type="number" name="production_year" class="form-control" placeholder="Production Year" required>
        </div>
        <div class="mb-2">
            <input type="text" name="duration" class="form-control" placeholder="Duration (e.g. 2h 10min)" required>
        </div>
        <div class="mb-2">
            <input type="text" name="genre" class="form-control" placeholder="Genre" required>
        </div>
        <div class="mb-2">
            <textarea name="synopsis" class="form-control" placeholder="Synopsis" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add Movie</button>
    </form>
</div>
</body>
</html>