var Vue = require('vue');

new Vue({
    el: '#queues-list',
    data: {
        queues: BotQueue.queues
    },
    computed: {
        total: function () {
            var self = this;
            var values = Object.keys(this.queues).map(function (key) {
                return self.queues[key]
            });
            return values.reduce(function (previous, current) {
                return {
                    'available': previous.available + parseInt(current.available),
                    'taken': previous.taken + parseInt(current.taken),
                    'completed': previous.completed + parseInt(current.completed),
                    'failed': previous.failed + parseInt(current.failed),
                    'total': previous.total + parseInt(current.total)
                }
            }, {'available': 0, 'taken': 0, 'completed': 0, 'failed': 0, 'total': 0});
        }
    }
});