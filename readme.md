############################################################
############    Setup Guide for Websockets      ############
############################################################

#1- Setup Laravel
    composer create-project --prefer-dist laravel/laravel example-socket "5.8.*"


#2- Setup Package (beyondcode/websockets)
   url(https://docs.beyondco.de/laravel-websockets/1.0/getting-started/installation.html)

    1- composer require beyondcode/laravel-websockets
    2- php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
    3- php artisan migrate
    4- php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"


#3- Setup Package (pusher)
   
   composer require pusher/pusher-php-server "~3.0"


#4- Setup Node Modules

    1- npm install
    2- npm install --save laravel-echo pusher-js


#5- Uncomment Broadcasting Service Provider

    1- config/app uncomment below provider
        App\Providers\BroadcastServiceProvider::class,

#6- Setup .env

    1- BROADCAST_DRIVER=pusher
    2- PUSHER_APP_ID=myId
    3- PUSHER_APP_KEY=myKey
    4- PUSHER_APP_SECRET=mySecret
    5- PUSHER_APP_CLUSTER=mt1 


#7- Setup Config server side

    1- Change pusher array to below in config/broadcasting.php
    
    
        'pusher' => [
                'driver' => 'pusher',
                'key' => env('PUSHER_APP_KEY'),
                'secret' => env('PUSHER_APP_SECRET'),
                'app_id' => env('PUSHER_APP_ID'),
                'options' => [
                    'cluster' => env('PUSHER_APP_CLUSTER'),
                    'host' => '127.0.0.1',
                    'port' => 6001,
                    'scheme' => 'http'
                ],
            ],

    2- Change apps array to below in config/websockets.php

            'apps' => [
                [
                    'id' => env('PUSHER_APP_ID'),
                    'name' => env('APP_NAME'),
                    'key' => env('PUSHER_APP_KEY'),
                    'secret' => env('PUSHER_APP_SECRET'),
                    'enable_client_messages' => false,
                    'enable_statistics' => true,
                ],
            ],


#8- Setup Laravel Echo config

    1- add below lines in resources/js/bootstrap.js

        import Echo from 'laravel-echo';

        window.Pusher = require('pusher-js');

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'myKey',
            wsHost: window.location.hostname,
            wsPort: 6001,
            disableStats: true,
        });


#9- Create Event to broadcast over socket

    php artisan make:event sendNotify


#10- Start Serving Websocket and Web

    1- php artisan serve
    2- php artisan websockets:serve



#11- All private channel will be created in routes/channel.php

    Public  ---- Channel for All site visitors
    Private  ---- Channel for all authenticated users
    Presence  ---- Channel which is authenticated as private channel but give us additional information (e.g who is typing)

    Broadcast::channel('user.{id}', function ($user, $id) {
        return true;//(int) $user->id === (int) $id;
    });


#12- Event Sent

    in the event

    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->id);
    }


#13- Listen to Private channel notification

    listenToYours() {
        Echo.private('user.'+this.user.data.id)
            .listen('sendSpecific', (eve) => {
                console.log(eve);
            });
    }
