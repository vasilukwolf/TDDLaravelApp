/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VModal from 'vue-js-modal';

Vue.use(VModal);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
Vue.component('theme-switcher', require('./components/ThemeSwitcher.vue').default);
Vue.component('new-project-modal', require('./components/NewProjectModal.vue').default);
Vue.component('dropdown', require('./components/Dropdown.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */




 const app = new Vue({
     el: '#app',

     data: {
         messages: []
     },

     created() {
         this.fetchMessages();
     },

     methods: {
         fetchMessages() {
             axios.get('/messages').then(response => {
                 this.messages = response.data;
             });
         },

         addMessage(message) {
             this.messages.push(message);

             axios.post('/messages', message).then(response => {
               console.log(response.data);
             });
         }
     }
 });

 Echo.private('chat')
  .listen('MessageSent', (e) => {
    this.messages.push({
      message: e.message.message,
      user: e.user
    });
  });
