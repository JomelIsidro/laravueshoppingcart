import Products from './components/Products.vue';
import Carts from './components/Carts.vue';
import History from './components/History.vue';
  
export const routes = [
    {
        name: 'product',
        path: '/',
        component: Products
    },
    {
        name: 'cart',
        path: '/cart',
        component: Carts
    },
    {
        name: 'history',
        path: '/history',
        component: History
    }
];