
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./argon');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// For products
Vue.component('vue-newbrand', require('./components/NewBrand.vue'));
Vue.component('vue-newcategory', require('./components/NewCategory.vue'));
Vue.component('vue-newstag', require('./components/NewPtag.vue'));

Vue.component('vue-newptag', require('./components/NewPtag.vue'));

// import { store } from './store'

const app = new Vue({
    el: '#app'
    // store
});
