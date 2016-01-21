<script>
    export default {
        user: {
            username: '',
            authenticated: false
        },
        login(token, username) {
            localStorage.setItem('BQ/token', token);
            localStorage.setItem('BQ/username', username);

            this.refreshLogin();
        },
        logout() {
            localStorage.removeItem('BQ/token');
            localStorage.removeItem('BQ/username');
            this.refreshLogin();
        },
        refreshLogin() {
            var jwt = localStorage.getItem('BQ/token');
            if(jwt) {
                this.user.username = localStorage.getItem('BQ/username');
                this.user.authenticated = true;
            } else {
                this.user.username = '';
                this.user.authenticated = false;
            }
        }
    }
</script>