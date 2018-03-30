<template>
    <div id="place">
        <div id="login">
            <div class="form-body">
                <div class="form-header">
                    Register
                </div>
                <form @submit.prevent="register()">
                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp" placeholder="Vaše imea" v-model="name">
                        <small class="form-text text-muted" v-if="errors && errors['name']">{{ errors['name'][0] }}</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Vaša email adresa" v-model="email">
                        <small class="form-text text-muted" v-if="errors && errors['email']">{{ errors['email'][0] }}</small>
                    </div>
                    <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Lozinka" v-model="password">
                        <small class="form-text text-muted" v-if="errors && errors['password']">{{ errors['password'][0] }}</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Password confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Potvrda lozinke" v-model="password_confirmation">
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
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                errors: null
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
                        this.errors = e.response.data.errors;
                    });
            }
        }
    }
</script>