import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import VueBQ from './BQ/index'

Vue.config.debug = true;

Vue.use(VueResource);
Vue.use(VueBQ);
Vue.use(VueRouter);

var router = new VueRouter({
    history: true,
    linkActiveClass: 'active'
});

router.map({
    '/': {
        component: require('./App.vue'),
        subRoutes: {
            '/': { component: require('./pages/Home/Welcome.vue') },
            '/about': { component: require('./pages/Home/About.vue') },

            'register': { component: require('./pages/Auth/Register.vue') },
            '/login': { component: require('./pages/Auth/Login.vue') },
            '/logout': { component: require('./pages/Auth/Logout.vue') },

            '/queues': { component: require('./pages/Queue/Index.vue') },
            '/queue/:id': {
                name: 'queue',
                component: require('./pages/Queue/View.vue')
            },

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
Vue.http.headers.common['Authorization'] = Auth.getAuthHeader();