
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

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('todo-list', require('./components/TodoList.vue').default);
Vue.component('todo-item', require('./components/TodoItem.vue').default);
Vue.component('avatar', require('./components/Avatar.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        vouchers : {},
        deliveryTypes: {},
        selectedVoucher : {},
        selectedDelivery: {},
        total: ''
    },
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

import Stepper from 'bs-stepper'

var stepper;
// Vanilla JavaScript
document.addEventListener('DOMContentLoaded', function () {
    stepper = new Stepper(document.querySelector('.bs-stepper'),{
        linear: false,
        animation: true,
        selectors: {
            steps: '.step',
            trigger: '.step-trigger',
            stepper: '.bs-stepper'
        }
    })
})

window.stepper_next = function ()
{
    stepper.next();
}

window.stepper_previous = function () {
    stepper.previous();
}

window.init_data = function (data) {
    app.vouchers = data
}




