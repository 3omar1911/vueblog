
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VeeValidate from 'vee-validate';
import App from './components/App.vue'
import Dashboard from './components/Dashboard.vue';
import PostsMain from './components/posts/Main.vue';
import ListPosts from './components/posts/List.vue';
import ManagePosts from './components/posts/Manage.vue';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.use(VueRouter)
Vue.use(VeeValidate);


const routes = [
  { path: '/', component: Dashboard },
  { 
  	path: '/posts', component: PostsMain, children: [
  		{path: '', name: 'posts.index', component: ListPosts},
  		{path: 'create', name: 'posts.create', component: ManagePosts},
  		{path: ':id/edit', name: 'posts.edit', component: ManagePosts},
  	],
  },
];

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    // components: {
    //     'app-component': App,
    // },
    router,
});
