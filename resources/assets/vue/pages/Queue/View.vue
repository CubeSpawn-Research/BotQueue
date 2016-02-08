<template>
    <div class="row">
        <div class="span8">
            This needs job to be completed first
        </div>
        <div class="span4">
            <!--
            @can('modify', $queue)
            <p>
                @can('edit', $queue)
                <a class="btn btn-primary" href="{{ route('queue:edit', [$queue]) }}">Edit Queue</a>
                @endcan

                {{--<a class="btn btn-warning" href="{{ route('queue:flush', [$queue]) }}">Flush Queue</a>--}}

                @can('delete', $queue)
                <a class="btn btn-danger" href="{{ route('queue:delete', [$queue]) }}">Delete Queue</a>
                @endcan
            </p>
            @endcan
            -->

            <h3>Delay: {{ delayText }}</h3>

            <h3>Bots</h3>
            Bots listing

            <h3>Statistics</h3>
            Some stats
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                queue: {}
            }
        },
        computed: {
            delayText() {
                if(this.queue.delay == 0) {
                    return "None";
                }
                return this.queue.delay;
            }
        },
        ready() {
            var self = this;
            var resource = this.$resource('/api/queue/:id');

            // get item
            resource.get({id: this.$route.params.id}).then(function (response) {
                console.log(response);
                self.$set('queue', response.data.queue)
            });
        }
    }
</script>