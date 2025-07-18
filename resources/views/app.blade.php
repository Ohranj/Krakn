<!DOCTYPE html>
<html lang="en" class="min-h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @inertiaHead
</head>

<body class="min-h-screen h-screen font-roboto">
    @inertia('root-container')
</body>

</html>