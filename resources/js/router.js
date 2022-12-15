// sintassi per utilizzare VueRouter 
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// importo le pagine

import UserRestaurantComponent from './pages/UserRestaurantComponent.vue'
import ProductComponent from './pages/ProductComponent.vue'
import NotFoundComponent from './pages/NotFoundComponent.vue'


const router = new VueRouter ({
     // inserisco la modalità hystory per eliminare il comporamento del cancelletto nell'url
     mode: 'history',
     routes: [
        //  rotta per la home (mostra tutti i ristoratori)
         {
            path : '/',
            name: 'home',
            component: UserRestaurantComponent
         },

        //  rotta per il singolo menu
         {
            path : '/:slug/menu',
            name: 'products-page',
            component: ProductComponent
         },
         //  rotta 404
      {
         path : '*/',
         name: 'not-found',
         component: NotFoundComponent
      },
   ],
   scrollBehavior(to, from, savedPosition) {
      // always scroll to top
      return { y: 0 }
   },
})
// inserisco la stringa export default a fine pagina per permettere l'utilizo di app.js
export default router;