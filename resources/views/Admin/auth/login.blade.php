<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/app.css'])
</head>

<body>
    <h1>login</h1>
    <div class="">
        <form action="" method="post" class="flex flex-col">
            @csrf
            <div>
                <label for="email">Email</label>
                @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <input class="@error('email')
                border border-red-500
            @enderror"
            type="email" name="email" placeholder="email">

            <div>
                <label for="password">Password</label>
                @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <input type="password" name="password" placeholder="password">

            <button type="submit">login</button>
        </form>
    </div>
</body>

</html>
