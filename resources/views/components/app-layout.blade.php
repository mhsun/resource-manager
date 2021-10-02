
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Resource Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div id="app">
    <x-header/>
    <main class="main pt-4">
        <div class="container">
            {{ $slot }}
        </div>
    </main>
</div>
</body>
</html>
