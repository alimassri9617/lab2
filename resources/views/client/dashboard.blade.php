<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    
    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-header {
            margin-top: 30px;
            margin-bottom: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        #search {
            margin: 20px 0;
            text-align: center;

        }
        input[type="text"] {
            width: 300px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
        button {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="dashboard-header text-center">
            <h1 class="display-4">Welcome to the Client Dashboard</h1>
            <p class="lead">Here is the list of available movies</p>
        </div>
        <form id="search" action={{ route('user.search') }} method="get">
            <input type="text" name="text" id="">
            <button>search</button>
        </form>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-film"></i> Movies List</h4>
            </div>
            <div class="card-body">
                @if($movies->isEmpty())
                    <div class="alert alert-warning text-center">
                        No movies available.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Production Year</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $movie)
                                    <tr>
                                        <td>{{ $movie->title }}</td>
                                        <td>{{ $movie->description }}</td>
                                        <td>{{ $movie->production_year }}</td>
                                        <td>{{ $movie->duration }} mins</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        {{-- <div class="revie">
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-star"></i> Reviews</h4>
                </div>
                <div class="card-body">
                    @if($reviews->isEmpty())
                        <div class="alert alert-warning text-center">
                            No reviews available.
                        </div>
                    @else
                        <ul class="list-group">
                            @foreach ($reviews as $review)
                                <li class="list-group-item">
                                    <strong>{{ $review->user->name }}</strong> ({{ $review->created_at->format('d M Y') }}):
                                    <p>{{ $review->content }}</p>
                                    <p>Rating: {{ $review->rating }} / 5</p>
                                    <p>Movie: {{ $review->movie->title }}</p>
                                </li>
                            @endforeach
                        
        </div>
    </div> --}}
</body>
</html>
