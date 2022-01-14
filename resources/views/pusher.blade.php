<head>
  <title>Laravel 8 Pusher Notification Example Tutorial - XpertPhp</title>
  <h1>Laravel 8 Pusher Notification Example Tutorial</h1>
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>
    console.log('hi');
    var pusher = new Pusher('5d7a7bf83bad04f4b324', {
      cluster: 'ap2',
      encrypted: true
    });
    console.log('pusher', pusher)
    var channel = pusher.subscribe('notify-channel');
    console.log('channel', channel)
    channel.bind('App\\Events\\Notify', function(data) {
      console.log('in');
      alert(data.message);
    });
  </script>
</head>