<template>
    <div class="row">
        <div class="signin span6 offset3">
            <div class="title">Already a member? Sign in:</div>
            <form class="form-horizontal" method="POST" @submit.prevent="onSubmit">
                <fieldset>
                    <bq-input-text v-ref:username name="username"></bq-input-text>

                    <bq-password-text v-ref:password name="password"></bq-password-text>

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
    import BQInputText from '../components/form/InputText.vue'
    import BQPasswordText from '../components/form/PasswordText.vue'
    import FormHelper from '../helpers/FormHelper.vue'
    import Auth from '../helpers/AuthHelper.vue'
    import Vue from 'vue'

    export default {
        data() {
            return {
            }
        },
        components: {
            'bq-input-text': BQInputText,
            'bq-password-text': BQPasswordText
        },
        methods: {
            onSubmit() {
                var self = this;
                FormHelper.submit('/api/login', {
                    username: this.$refs.username,
                    password: this.$refs.password
                }, function(response) {
                    Auth.login(response.data.token, response.data.username);
                    self.$route.router.go('/');
                }, function(response) {
                    if(response.data.error = 'invalid_credentials') {
                        self.$refs.username.error = 'I\'m sorry, but I couldn\'t log you in';
                    }
                });
            }
        }
    }
</script>