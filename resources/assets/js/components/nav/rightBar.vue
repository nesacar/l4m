<template>
    <div id="rightMenu" :class="{'active': showRightBar}">
        <h3>Chat</h3>
        <p class="title">online</p>
        <ul class="online">
            <li v-for="user in loginUsers">
                <img :src="domain + 'img/user-image.png'" alt="Vue Admin Panel" v-if="user.image == null || user.image == ''">
                <img :src="domain + user.image" :alt="user.name" v-else>
                <span class="active"></span>
                <div>
                    <p>{{ user.name }}</p>
                    <p v-if="user.role_id == 1">@admin</p>
                    <p v-else>@editor</p>
                </div>
            </li>
        </ul>
        <p class="title">offline</p>
        <ul class="offline">
            <li v-for="user in logoutUsers">
                <img :src="domain + 'img/user-image.png'" alt="Vue Admin Panel" v-if="user.image == null || user.image == ''">
                <img :src="domain + user.image" :alt="user.name" v-else>
                <span class="active"></span>
                <div>
                    <p>{{ user.name }}</p>
                    <p v-if="user.role_id == 1">@admin</p>
                    <p v-else>@editor</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import { apiHost } from '../../config';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                domain : apiHost,
                loginUsers: {},
                logoutUsers: {}
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon
        },
        computed: {
            showRightBar(){
                return this.$store.getters.getShowRightBar;
            }
        },
        created(){
            this.getUsers();
        },
        methods: {
            getUsers(){
                axios.get('api/users/get-users')
                    .then( res => {
                        this.loginUsers = res.data.loginUsers;
                        this.logoutUsers = res.data.logoutUsers;
                    })
                    .catch( e => {
                        console.log(e.response);
                        this.error = e.response.data;
                    });
            }
        }
    }
</script>

<style>

</style>