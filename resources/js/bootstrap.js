window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest',
    'Authorization': 'Bearer notvalidstring' //+ Laravel.apiToken,
};

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
//import { hasMagic } from 'glob';

window.Pusher = require('pusher-js');

let token = document.head.querySelector('meta[name="csrf-token"]');
//var token = 'asdfsadfasdfasdf';



window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'myKey',
    wsHost: window.location.hostname,
    wsPort: 37496,
    wssPort: 37496,
//    wsHost: 'latestdesignplatform.breakoutedu.com',
//    wsPort: 37496,
//    wssPort: 37496,
//    authEndpoint: 'https://websocket.breakoutedu.com/broadcasting/auth',
//     auth: {
//         headers: window.axios.defaults.headers.common
//    },
    disableStats: true,
    encrypted: true,
});
// Route::resource('/verif', 'testingController');
