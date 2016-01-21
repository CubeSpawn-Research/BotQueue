<script>
    import Auth from '../helpers/AuthHelper.vue'

    export default {
        ready() {
            Auth.logout();
            this.$route.router.go('/');
        }
    }
</script>