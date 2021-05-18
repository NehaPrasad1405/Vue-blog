require('./bootstrap');

window.Vue = require('vue');

Vue.component('categories', require('./components/categories/categories.vue').default);
Vue.component('confirmation', require('./components/confirmation.vue').default);
Vue.component('computed', require('./components/computed.vue').default);

Vue.component('blogs', require('./components/blogs/blogs.vue').default);

Vue.component('tags', require('./components/tags/tags.vue').default);


const app = new Vue({
    el: '#app',
});
