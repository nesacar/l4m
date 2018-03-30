<template>

</template>

<script>
    export default {
        created(){
            axios.get('api/users/logout')
                .then(res => {
                    if(res.data.message == 'logout user' || res.status == 200){
                        this.$auth.destroyToken();
                        this.$router.push('/login');
                    }
                })
                .catch(e => {
                    if(e.response.status == 401){
                        this.$auth.destroyToken();
                        this.$router.push('/login');
                    }
                });
        }
    }
</script>