var Vue = require('vue');
var BotStatus = require('../bot_status.vue');

new Vue({
    el: '#bots-list',
    components: {
        'bq-bot-status': BotStatus
    },
    data: {
        bots: BotQueue.bots
    }
});