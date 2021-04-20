
import Echo from "laravel-echo"

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'a7af67af5a4b48377546',
  cluster: 'eu',
  forceTLS: true
});

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
