/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

import { isArray } from 'lodash';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// import  form ''

// const app = new Vue({
//     el: '#app',
// });

// includo axios
window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// importiamo il componente principale di vue
import App from './views/App.vue' ;

// importo il file router.js
import router from './router.js'

const app = new Vue({
    // sostituiamo public con root
    el: '#root', 
    // avvia come primo componente vue 
    render: h=> h(App),
    // passo come argomento router
    router
});


// START FORM LABELS ANIMATION LOGIC
const formInputs = document.querySelectorAll('.ms_js-get-input');
const formLabels = document.querySelectorAll('.ms_js-get-label');

for(let i = 0; i < formInputs.length; i++) {
    let input = formInputs[i];

    for(let i = 0; i < formLabels.length; i++) {
        let label = formLabels[i];
        
        if(input.value !== "") {
            if(label.getAttribute('for') === input.id) {
                label.classList.add('ms_label-active');
            }
        }

        input.addEventListener('input', function() {
            
            for(let i = 0; i < formLabels.length; i++) {
                label = formLabels[i];

                if(input.value.length > 0) {
                    if(label.getAttribute('for') === input.id) {
                        label.classList.add('ms_label-active');
                    }
                    
                } else {
                    if(label.getAttribute('for') === input.id) {
                        label.classList.remove('ms_label-active');
                    }
                }
            }
        });
    }
}
// END FORM LABELS ANIMATION LOGIC

