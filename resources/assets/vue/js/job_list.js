var Vue = require('vue');
var JobList = require('../job_list.vue');

new Vue({
    el: '#jobs',
    components: {
        'bq-job-list': JobList
    },
    data: {
        jobs: BotQueue.jobs
    }
});