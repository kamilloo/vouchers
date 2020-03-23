
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('@voerro/vue-tagsinput/dist/style.css');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('tags-input', require('@voerro/vue-tagsinput/src/VoerroTagsInput').default);

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('branch-input', require('./components/BranchInput.vue').default);
Vue.component('file-upload', require('./components/FileUpload.vue').default);
Vue.component('checkout-form', require('./components/CheckoutForm.vue').default);
Vue.component('stepper', require('./components/Stepper.vue').default);
Vue.component('template-checkbox', require('./components/TemplateCheckbox.vue').default);
Vue.component('my-template', require('./components/MyTemplate.vue').default);
Vue.component('shop-input', require('./components/ShopInput.vue').default);
Vue.component('voucher-type-select', require('./components/VoucherTypeSelect.vue').default);
Vue.component('add-voucher-service-select', require('./components/AddVoucherServiceSelect.vue').default);
Vue.component('voucher-form', require('./components/VoucherForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        selectedVoucher : {
            id: null,
            price: null,
            name: null,
        },
        selectedDelivery: {
            type: null,
            cost: null,
            title: null,
        },
        checked: 5,
        translate: {
            wishList: "Lista życzeń",
            total: "Całość",
        },
        voucherType: ''
    },
    methods :{
        changeValue(value) {
            this.checked = value;
        },
        colsoling(value){
            console.log(value)
        }
    }
});

window.editButtonFocusIn = function(button) {

    button.style.background = "#fff";
};

window.editButtonFocusOut = function(button) {
    button.style.background = "";
};

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').click(function () {
        $('form').submit();
    })
});


var stepper;






