
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./GoogleAutoCompleteStore');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));




Vue.component('market-news', require('./components/MarketNews.vue'));
Vue.component('stock-app', require('./components/StockApp.vue'));
Vue.component('latest-news', require('./components/LatestNews.vue'));
Vue.component('new-members', require('./components/NewMembers.vue'));
Vue.component('scfi-widget', require('./components/SCFI.vue'));
Vue.component('location-widget', require('./components/RegisterLocationWidget.vue'));
Vue.component('google-places', require('./components/GoogleAutocomplete.vue'));



new Vue({
	el: '#app',

});
