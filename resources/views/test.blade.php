<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Master</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-dark table-bordered">
            <thead class="thead-dark">
                <tr style="background-color: gray">
                    <th>id</th>
                    <th>name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cat as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td><a class="btn btn-warning" href="{{ route('delete', ['id' => $item->id]) }}">delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $cat->links() }}
    </div>
</body>

</html>
