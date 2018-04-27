<template>
    <div id="leftMenu" :class="{ 'hide': hideLeftBar }" v-if="user">
        <div class="logo-holder">
            <div class="logo">
                <a :href="domain" target="_blank">
                    <img :src="domain + 'img/logo.png'" alt="Fusion Tables">
                </a>
            </div>
        </div>
        <ul>
            <li>
                <font-awesome-icon icon="home" />
                <router-link tag="a" :to="'/home'">Početna</router-link>
            </li>
            <li :class="{ 'active': showSettingsItemActive }" :style="{ 'display': showSettingsItem ? 'block' : 'none' }">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowSettingsItemActive()">Podešavanja</a>
                <font-awesome-icon icon="cogs"/>
                <ul>
                    <li><router-link tag="a" :to="'/settings/1/edit'">SEO</router-link></li>
                    <li><router-link tag="a" :to="'/themes'">Teme</router-link></li>
                    <li><router-link tag="a" :to="'/menus'">Meni</router-link></li>
                </ul>
            </li>
            <li :class="{ 'active': showTemplatesItemActive }" :style="{ 'display': showTemplatesItem ? 'block' : 'none' }">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowTemplatesItemActive()">Šabloni</a>
                <font-awesome-icon icon="th-large" />
                <ul>
                    <li><router-link tag="a" :to="'/blocks'">Šabloni</router-link></li>
                    <li><router-link tag="a" :to="'/boxes'">Slajdovi</router-link></li>
                    <li><router-link tag="a" :to="'/shop-bars'">ShopBars</router-link></li>
                </ul>
            </li>
            <li :class="{ 'active': showUsersItemActive }" :style="{ 'display': showUsersItem ? 'block' : 'none' }" v-if="admin">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowUsersItemActive()">Korisnici</a>
                <font-awesome-icon icon="users" />
                <ul>
                    <li><router-link tag="a" :to="'/users'">Pregled korisnika</router-link></li>
                </ul>
            </li>
            <li :class="{ 'active': showProductsItemActive }" :style="{ 'display': showProductsItem ? 'block' : 'none' }">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowProductsItemActive()">Prodavnica</a>
                <font-awesome-icon icon="shopping-cart" />
                <ul>
                    <li><router-link tag="a" :to="'/products'">Proizvodi</router-link></li>
                    <li><router-link tag="a" :to="'/categories'">Kategorije</router-link></li>
                    <li><router-link tag="a" :to="'/brands'">Brendovi</router-link></li>
                    <li><router-link tag="a" :to="'/collections'">Kolekcije</router-link></li>
                    <li><router-link tag="a" :to="'/properties'">Osobine</router-link></li>
                    <li><router-link tag="a" :to="'/attributes'">Atributi</router-link></li>
                    <li><router-link tag="a" :to="'/sets'">Setovi</router-link></li>
                </ul>
            </li>
            <li :class="{ 'active': showPostsItemActive }" :style="{ 'display': showPostsItem ? 'block' : 'none' }">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowPostsItemActive()">Članci</a>
                <font-awesome-icon icon="paste" />
                <ul>
                    <li><router-link tag="a" :to="'/posts'">Članci</router-link></li>
                    <li><router-link tag="a" :to="'/blogs'">Kategorije</router-link></li>
                </ul>
            </li>
            <li>
                <font-awesome-icon icon="images" />
                <a :href="domain + 'filemanager/show'" target="_blank">File manager</a>
            </li>
            <li>
                <font-awesome-icon icon="tags" />
                <router-link tag="a" :to="'/tags'">Tagovi</router-link>
            </li>
            <!--
            <li :class="{ 'active': showNewslettersItemActive }" :style="{ 'display': showNewslettersItem ? 'block' : 'none' }">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowNewslettersItemActive()">Newsletter</a>
                <font-awesome-icon icon="envelope" />
                <ul>
                    <li><a href="#">Newsletter review</a></li>
                    <li><a href="#">Subscriber review</a></li>
                    <li><a href="#">Banner review</a></li>
                </ul>
            </li>
            -->
        </ul>
    </div>
</template>

<script>
    import { apiHost } from '../../config';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                domain : apiHost
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon
        },
        computed: {
            /** auth **/
            user(){
                return this.$store.getters.getUser;
            },

            admin(){
                return this.$store.getters.isAdmin;
            },

            /** nav **/
            hideLeftBar(){
                return this.$store.getters.getHideLeftBar;
            },

            /** settings **/
            showSettingsItem(){
                return this.$store.getters.getShowSettingsItem;
            },
            showSettingsItemActive(){
                return this.$store.getters.getSettingsItemActive;
            },

            /** users **/
            showUsersItem(){
                return this.$store.getters.getShowUsersItem;
            },
            showUsersItemActive(){
                return this.$store.getters.getUsersItemActive;
            },

            /** posts **/
            showPostsItem(){
                return this.$store.getters.getShowPostsItem;
            },
            showPostsItemActive(){
                return this.$store.getters.getPostsItemActive;
            },

            /** products **/
            showProductsItem(){
                return this.$store.getters.getShowProductsItem;
            },
            showProductsItemActive(){
                return this.$store.getters.getProductsItemActive;
            },

            /** newsletters **/
            showNewslettersItem(){
                return this.$store.getters.getShowNewslettersItem;
            },
            showNewslettersItemActive(){
                return this.$store.getters.getNewslettersItemActive;
            },

            /** templates **/
            showTemplatesItem(){
                return this.$store.getters.getShowTemplatesItem;
            },
            showTemplatesItemActive(){
                return this.$store.getters.getTemplatesItemActive;
            },
        },
        methods: {
            /** settings **/
            changeShowSettingsItemActive(){
                this.$store.dispatch('changeSettingsItemActive');
            },

            /** users **/
            changeShowUsersItemActive(){
                this.$store.dispatch('changeUsersItemActive');
            },

            /** posts **/
            changeShowPostsItemActive(){
                this.$store.dispatch('changePostsItemActive');
            },

            /** products **/
            changeShowProductsItemActive(){
                this.$store.dispatch('changeProductsItemActive');
            },

            /** products **/
            changeShowNewslettersItemActive(){
                this.$store.dispatch('changeNewslettersItemActive');
            },

            /** galleries **/
            changeShowTemplatesItemActive(){
                this.$store.dispatch('changeTemplatesItemActive');
            },
        }
    }
</script>