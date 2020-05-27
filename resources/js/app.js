/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import CKEditor from '@ckeditor/ckeditor5-vue'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate' //IMPORT LIBRARY
import store from './store.js'

import App from './App.vue'
// LightBootstrap plugin
import LightBootstrap from './themejs/light-bootstrap-main'

// router setup
import routes from './routes/routes'

Vue.config.productionTip = false;

Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons)
Vue.use(CKEditor);
// plugin setup
Vue.use(VueRouter)
Vue.use(LightBootstrap)
Vue.use(Vuelidate) //DEFINE AS GLOBAL


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    //base: '/apps/',
    mode: 'history',
    routes, // short for routes: routes
    linkActiveClass: 'nav-item active',
    scrollBehavior: (to) => {
      if (to.hash) {
        return {selector: to.hash}
      } else {
        return { x: 0, y: 0 }
      }
    }
  });
  
//Navigation Guards
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth
        if (!auth) {
            next({ name: 'Home' })
        } else {
            next()
        }
    } else {
        next()
    }
});

const app = new Vue({
    el: '#app',
    router,
	store,
    components: { App }
});
