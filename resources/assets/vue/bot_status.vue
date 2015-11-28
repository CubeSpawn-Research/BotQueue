<template id="bq-bot-status">
    <div class="btn-group bot_status_button">
        <a class="btn btn-mini btn-bot-status dropdown-toggle" :class="class" data-toggle="dropdown"
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
                        text: 'Bring Online',
                        icon: 'icon-play'
                    },
                    offline: {
                        text: 'Take Offline',
                        icon: 'icon-stop'
                    },
                    edit: {
                        text: 'Edit Bot',
                        icon: 'icon-cog'
                    },
                    delete: {
                        text: 'Delete Bot',
                        icon: 'icon-remove'
                    }
                }
            }
        },
        computed: {
            class: function () {
                return {
                    idle: 'btn-success',
                    working: 'btn-info',
                    slicing: 'btn-info',
                    waiting: 'btn-warning',
                    error: 'btn-danger',
                    offline: 'btn-inverse',
                    retired: 'btn-inverse',
                    maintenance: 'btn-info'
                }[this.status];
            },
            transition: function () {
                return {
                    idle: [
                        this.options.offline,
                        this.options.edit,
                        this.options.delete
                    ],
                    offline: [
                        this.options.idle
                    ]
                }[this.status];
            }
        }
    };
</script>