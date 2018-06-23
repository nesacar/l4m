<template>
    <div id="place">
        <div id="login">
            <div class="form-body">
                <div class="form-header">
                    Register
                </div>
                <form @submit.prevent="register()">

                    <text-field :value="''" :label="'Ime'" :error="error? error.name : ''" @changeValue="name = $event"></text-field>

                    <email-field :value="''" :label="'Email adresa'" :error="error? error.email : ''" @changeValue="email = $event"></email-field>

                    <password-field :value="''" :label="'Lozinka'" :error="error? error.password : ''" @changeValue="password = $event"></password-field>

                    <password-field :value="''" :label="'Potvrda lozinke'" :error="error? error.password_confirmation : ''" @changeValue="password_confirmation = $event"></password-field>

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
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                error: null
            }
        },
        methods: {
            register(){
                let data = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                };
                axios.post('register', data)
                    .then( res => {
                        if(res.status == 200){
                            this.$router.push('/login');
                        }
                    })
                    .catch( e => {
                        console.log(e.response.data);
                        this.error = e.response.data.errors;
                    });
            }
        }
    }
</script>