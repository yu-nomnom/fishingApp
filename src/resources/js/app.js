import Vue from "vue";
import VueRouter from 'vue-router';
import router from './router';
import BootstrapVue from "bootstrap-vue"
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

require('./bootstrap');

window.Vue = Vue;
Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    BootstrapVue
});