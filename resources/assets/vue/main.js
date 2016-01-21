import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

Vue.config.debug = true;

Vue.use(VueResource);

Vue.use(VueRouter);

var router = new VueRouter({
    history: true,
    linkActiveClass: 'active'
});

router.map({
    '/': {
        component: require('./App.vue'),
        subRoutes: {
            '/': { component: require('./pages/Welcome.vue') },
            '/about': { component: require('./pages/About.vue') },
            '/login': { component: require('./pages/Login.vue') },
            '/logout': { component: require('./pages/Logout.vue') },
            '/*any': {
                component: {
                    template: '404'
                }
            }
        }
    }
});

var MyApp = Vue.extend({});
router.start(MyApp, '#app');

import Auth from './helpers/AuthHelper.vue'
Auth.refreshLogin();