
import Echo from "laravel-echo"

window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster:'pusher',
  key:'d03731d29b66596f9a91',
  cluster:'eu',
  forceTLS:true
});

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
