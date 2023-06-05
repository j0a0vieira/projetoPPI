<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('content')
    <h1>Lista de Lugares</h1>
    <ul>
        @foreach ($lugares as $lugar)
            <li>{{ $lugar }}</li>
        @endforeach
    </ul>
@endsection

</body>
</html>