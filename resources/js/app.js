require("./bootstrap");

window.Vue = require("vue").default;
import VueGoodTablePlugin from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";

Vue.use(VueGoodTablePlugin);

// v-select
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', vSelect)

// jquery
window.$ = require('jquery')

// ck editor
import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );

Vue.component("Dashboard", require("./components/Dashboard.vue").default);
Vue.component("Bank", require("./components/Bank.vue").default);
Vue.component("Product", require("./components/Product.vue").default);
Vue.component("published_product", require("./components/publishedProduct.vue").default);
Vue.component("Customer", require("./components/Customer.vue").default);
Vue.component("Technician", require("./components/Technician.vue").default);
Vue.component("Slider", require("./components/Slider.vue").default);
Vue.component("Blog", require("./components/Blog.vue").default);
Vue.component("Orderlist", require("./components/OrderList.vue").default);
Vue.component("proccess-order", require("./components/processOrder.vue").default);
Vue.component("delivered-order", require("./components/deliveredOrder.vue").default);
Vue.component("cancel-order", require("./components/cancelOrder.vue").default);
Vue.component("invoice", require("./components/Invoice.vue").default);
Vue.component("Report", require("./components/Report.vue").default);

const app = new Vue({
    el: "#app",
});
