
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Toasted from 'vue-toasted';

Vue.use(Toasted)

// you can also pass options, check options reference below

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('tabs', require('./components/tabs.vue'));
Vue.component('tab', require('./components/tab.vue'));
Vue.component('dashboard', require('./components/dashboard.vue'));
Vue.component('entry', require('./components/entry.vue'));
Vue.component('reports', require('./components/reports.vue'));
Vue.component('imageupload', require('./components/imageupload.vue'));
Vue.component('test', require('./components/test.vue'));


const app = new Vue({
    el: '#app'
});
