import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.config.debug = true;

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