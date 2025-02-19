<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>hi</p>
    <form action="{{ route('test.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="image" type="file">
        <button value="submit">submit</button>
    </form>

    @session('IMAGE')
        <p>{{ $value }}</p>
        <img src="test001/{{ Session::get('IMAGE') }}">
    @endsession
</body>
</html>