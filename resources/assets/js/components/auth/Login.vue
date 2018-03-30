<template>
    <div id="place">
        <div id="login">
            <div class="form-body">
                <div class="form-header">
                    Login
                </div>
                <form @submit.prevent="login()">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your email address" v-model="email">
                        <small class="form-text text-muted" v-if="error != null">{{ error.error }}</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Lozinka" v-model="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
                    client_secret: 'gpjvqhGsTA3ecPITmCDq36Eswf7OxRFzS7QqCbOe',
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