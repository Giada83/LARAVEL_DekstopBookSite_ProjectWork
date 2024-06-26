<!DOCTYPE html>
<html>

<head>
    <title>Authors List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Authors List</h1>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Image</th>
                    <th>Nationality</th>
                    <th>Year Born</th>
                    <th>Year Die</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->surname }}</td>
                        <td>
                            @if ($author->image)
                                <img src="{{ $author->image }}" alt="{{ $author->name }}" style="width: 100px;">
                            @endif
                        </td>
                        <td>{{ $author->nationality }}</td>
                        <td>{{ $author->year_born }}</td>
                        <td>{{ $author->year_die }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
