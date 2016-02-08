function install(Vue) {
    var _ = require('./util');

    Vue.BQ = require('./BQ');

    Object.defineProperties(Vue.prototype, {
        $bq: {
            get() {
                return _.options(Vue.BQ, this, this.$options.bq);
            }
        }
    });
}

if (window.Vue) {
    Vue.use(install);
}

module.exports = install;