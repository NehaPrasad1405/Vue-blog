require('./bootstrap');

window.Vue = require('vue');

Vue.component('categories', require('./components/categories/categories.vue').default);

const app = new Vue({
    el: '#app',
});
