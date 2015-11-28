<template id="bq-bot-status">
    <div class="btn-group bot_status_button">
        {{ status }}
    </div>
</template>

<script>
    Vue.component({
        template: '#bq-bot-status',

        props: ['status'],

        data: function () {
            return {
                options: {
                    idle: {
                        text: 'bring online',
                        icon: 'icon-play',
                        class: 'btn-success'
                    },
                    offline: {
                        text: 'bring offline',
                        icon: 'icon-stop',
                        class: 'btn-inverse'
                    }
                },
                transitions: {
                    idle: [
                        this.options.offline
                    ],
                    offline: [
                        this.options.idle
                    ]
                }
            }
        }
    });
</script>