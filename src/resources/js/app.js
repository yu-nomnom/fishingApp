require('./bootstrap');

window.Vue = require('vue');

import Vue from "vue";
import router from "./router";

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-diary', require('./components/CreateDiary.vue').default);

const app = new Vue({
    el: '#app',
    router: router
});