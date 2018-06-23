<template>
    <div id="place">
        <div id="login">
            <div class="form-body">
                <div class="form-header">
                    Login
                </div>
                <form @submit.prevent="login()">

                    <email-field :value="''" :label="'Email adresa'" :error="error? error.error : ''" @changeValue="email = $event"></email-field>

                    <password-field :value="''" :label="'Lozinka'" :error="error? error.error : ''" @changeValue="password = $event"></password-field>

                    <button type="submit" class="btn btn-primary">Potvrdi</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                email: '',
                password: '',
                error: null
            }
        },
        methods: {
            login(){
                let data = {
                    client_id: 2,
                    client_secret: 'DhbbKtMNwymeo9feAhIbxpa2UQaVbCPkL4Ss2vpS',
                    grant_type: 'password',
                    username: this.email,
                    password: this.password
                };
                axios.post('oauth/token', data)
                    .then( res => {
                        this.$auth.setToken(res.data.access_token, res.data.expires_in + Date.now());
                        this.$router.push('/home');
                    })
                    .catch( e => {
                        console.log(e.response);
                        this.error = e.response.data;
                    });
            }
        }
    }
</script>