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

        @session("success")
            <div
                id="session-success"
                class="bg-primary absolute right-4 bottom-4 rounded-lg px-4 py-3"
            >
                {{ $value }}
            </div>
        @endsession
    </body>
</html>
