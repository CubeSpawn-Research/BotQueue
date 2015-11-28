<template id="bq-bot-status">
    <div class="btn-group bot_status_button">
        <a class="btn btn-mini btn-bot-status dropdown-toggle" :class="options[status].class" data-toggle="dropdown"
           href="#">
            <span>{{ status }}</span>
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li v-for="option in transition">
                <a>
                    <i :class="option.icon"></i>
                    {{option.text}}
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    module.exports = {
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
                }
            }
        },
        computed: {
            transition: function () {
                return {
                    idle: [
                        this.options.offline
                    ],
                    offline: [
                        this.options.idle
                    ]
                }[this.status];
            }
        }
    };
</script>