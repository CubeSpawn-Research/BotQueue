import Rx from 'rx'
import Vue from 'vue'

export default {
    queues() {
        return Rx.Observable
            .interval(60 * 1000)
            .startWith(0)
            .flatMapLatest(function () {
                return Vue.http.get('/api/queues')
            })
            .map(function (request) {
                return request.data;
            });
    }
}