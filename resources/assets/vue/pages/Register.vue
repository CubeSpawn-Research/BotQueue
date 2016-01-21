<template>
    <div class="row">
        <div class="signin span6 offset3">
            <div class="title">Already a member? Sign in:</div>
            <form class="form-horizontal" method="POST" @submit.prevent="onSubmit">
                <fieldset>
                    <bq-input v-ref:username
                              name="username"
                              label="Username"
                              type="text">
                    </bq-input>

                    <bq-input v-ref:email
                              name="email"
                              label="Email Address"
                              type="email"
                    ></bq-input>

                    <bq-input v-ref:password
                              name="password"
                              label="Password"
                              type="password">
                    </bq-input>

                    <bq-input v-ref:password_confirmation
                              name="password_confirmation"
                              label="Password Confirmation"
                              type="password">
                    </bq-input>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success btn-large">
                            Create your account
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
    import BQInput from '../components/form/Input.vue'
    import FormHelper from '../helpers/FormHelper.vue'
    import Auth from '../helpers/AuthHelper.vue'

    export default {
        components: {
            'bq-input': BQInput
        },
        methods: {
            onSubmit() {
                var self = this;
                FormHelper.submit('/api/register', {
                    username: this.$refs.username,
                    email: this.$refs.email,
                    password: this.$refs.password,
                    password_confirmation: this.$refs.password_confirmation
                }, function(response) {
                    Auth.login(response.data.token, response.data.username);
                    self.$route.router.go('/');
                });
            }
        }
    }
</script>