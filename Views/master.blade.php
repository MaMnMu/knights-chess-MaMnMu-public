<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>SaltoCaballo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="\public\assets\css\stylesheet.css">
    </head>

    <body>
        <a href='index.php?newgamebutton'>Jugar de nuevo</a>
        <h1>Salto de caballo</h1>
        @yield('content')
        <h2 id='mensaje'></h2>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="\public\assets\js\game.js"></script>
    </body>
</html>

