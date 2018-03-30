<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li>Home</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Homepage</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            user(){
                return this.$store.getters.getUser;
            }
        },
        created(){
            this.storeUser();
        },
        methods: {
            /** auth **/
            storeUser(){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$auth.getToken();
                console.log('hello from home');
                if(this.$store.getters.getUser == null){
                    axios.get('api/user')
                        .then(res => {
                            this.$store.dispatch('changeUser', res.data);
                        })
                        .catch(e => {
                            if(e.response.status == 401){
                                this.$auth.destroyToken();
                                this.$router.push('/login');
                            }
                        });
                }
            }
        }
    }
</script>

<style>

</style>