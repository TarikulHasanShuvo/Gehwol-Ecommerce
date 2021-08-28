
import Vue from 'vue';
require('./bootstrap');
require('./frontEnd');
require('./backend-form/contact');
require('./backend-form/wholesale');
require('./backend-form/newsLetterSubscripton');
import moment from 'moment'

Vue.prototype.moment = moment


import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.component('pagination', require('laravel-vue-pagination'));
import Vue2Editor from "vue2-editor";

Vue.use(Vue2Editor);
Vue.use(VueToast);
Vue.use(VueSweetalert2);




Vue.component('CategoryComponent', require('./components/category/CategoryComponent.vue').default);
Vue.component('OrderComponent', require('./components/order/OrderComponent.vue').default);
Vue.component('ProductComponent', require('./components/product/ProductComponent.vue').default);
Vue.component('ProductCreateComponent', require('./components/product/ProductCreateComponent.vue').default);
Vue.component('ProductEditComponent', require('./components/product/ProductEditComponent.vue').default);
Vue.component('ContactComponent', require('./components/contact/ContactComponent.vue').default);
Vue.component('BlogComponent', require('./components/blog/BlogComponent.vue').default);
Vue.component('GiftCertificateComponent', require('./components/gift-certificate/GiftCertificateComponent.vue').default);
Vue.component('WholeSaleComponent', require('./components/whole-sale/WholeSaleComponent.vue').default);
Vue.component('SubscriptionComponent', require('./components/subscription/SubscriptionComponent.vue').default);
Vue.component('EventComponent', require('./components/event/EventComponent.vue').default);



Vue.config.productionTip = false;
const app = new Vue({
    el: "#app",
});


