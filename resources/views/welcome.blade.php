<!DOCTYPE html>
<html>
<head>
    <title>Livewire Portfolio Demo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">
    
    <livewire:fast-dashboard />

    @livewireScripts
</body>
</html>