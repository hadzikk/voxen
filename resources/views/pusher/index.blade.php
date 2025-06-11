<!DOCTYPE html>
<html>
<head>
    <title>Pusher Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>
<body>
    <h1>Pusher Test</h1>
    <ul id="output"></ul>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            forceTLS: true
        });

        var channel = pusher.subscribe('chat');
        channel.bind('App\\Events\\Chat', function(data) {
            console.log('Event received:', data); // Debug log
            var ul = document.getElementById('output');
            var li = document.createElement('li');
            li.textContent = data.message;
            ul.appendChild(li);
        });
    </script>
</body>
</html>