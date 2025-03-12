<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    umjyhngbfvdcsx
    {{$customer->id}}
    <div class="my-14">
        <h1 class="text-2xl font-bold">Actualizacion de tu perfil</h1>
        <p class="text-md font-medium">para continuar ingrese al siguiente link</p>
        <a href="{{ route('perfil.edit', $customer->id) }}" class="hover:underline">Click Aqui</a>
    </div>
</body>
</html>
