@props(["title" => "Laravel"])
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Document</title>

        @vite(["resources/js/app.js", "resources/css/app.css"])
    </head>
    <body class="bg-background text-foreground mx-auto max-w-7xl">
        <x-layout.nav />
        <main>
            {{ $slot }}
        </main>
    </body>
</html>
