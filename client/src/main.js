import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import routes from './routes';

Vue.config.productionTip = false;

const store = {
    debug: true,
    state: {
        loading: 0,
    },
    isLoading: function () {
        return this.state.loading > 0;
    },
    setLoading: function () {
        this.state.loading++;
    },
    clearLoading: function () {
        this.state.loading--;
    },
};

Vue.use(VueRouter);

// Configure router
const router = new VueRouter({
    routes,
    linkActiveClass: 'active',
    mode: 'history'
});

new Vue({
    el: '#app',
    data: {
        privateState: {},
        sharedState: store,
    },
    render: h => h(App),
    router,
    vuetify
});
