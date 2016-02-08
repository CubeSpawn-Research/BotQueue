<template>
    <div class="row">
        <div class="signin span6 offset3">
            <div class="title">Not a member? Create a free account:</div>
            <form class="form-horizontal" method="POST" @submit.prevent="onSubmit">
                <fieldset>
                    <bq-input v-ref:username
                              name="username"
                              label="Username"
                              type="text">
                    </bq-input>

                    <bq-input v-ref:password
                              name="password"
                              label="Password"
                              type="password">
                    </bq-input>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-large">
                            Sign into your account
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
    import BQInput from '../../components/form/Input.vue'
    import Auth from '../../helpers/AuthHelper.vue'

    export default {
        components: {
            'bq-input': BQInput
        },
        methods: {
            onSubmit() {
                var self = this;
                this.$bq.Form.submit('/api/login', {
                    username: this.$refs.username,
                    password: this.$refs.password
                }, function (response) {
                    Auth.login(response.data.token, response.data.username);
                    self.$route.router.go('/');
                }, function (response) {
                    if (response.data.error = 'invalid_credentials') {
                        self.$refs.username.error = 'I\'m sorry, but I couldn\'t log you in';
                    }
                });
            }
        }
    }
</script>