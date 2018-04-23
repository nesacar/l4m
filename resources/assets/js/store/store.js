import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        /** auth **/
        user: null,

        admin: false,

        /** show nav bars **/
        showRightBar: false,
        hideLeftBar: false,

        /** nav settings **/
        settingsItemActive: false,
        showSettingsItem: true,

        /** nav users **/
        showUsersItem: true,
        usersItemActive: false,

        /** nav posts **/
        showPostsItem: true,
        postsItemActive: false,

        /** nav products **/
        showProductsItem: true,
        productsItemActive: false,

        /** nav newsletters **/
        showNewslettersItem: true,
        newslettersItemActive: false,

        /** nav templates **/
        showTemplatesItem: true,
        templatesItemActive: false,
    },
    getters: {
        /** auth **/
        getUser: state => {
            return state.user;
        },

        isAdmin: state => {
            return state.admin;
        },

        /** show nav bars **/
        getShowRightBar: state => {
            return state.showRightBar;
        },
        getHideLeftBar: state => {
            return state.hideLeftBar;
        },

        /** nav settings **/
        getShowSettingsItem: state => {
            return state.showSettingsItem;
        },
        getSettingsItemActive: state => {
            return state.settingsItemActive;
        },

        /** nav users **/
        getShowUsersItem: state => {
            return state.showUsersItem;
        },
        getUsersItemActive: state => {
            return state.usersItemActive;
        },

        /** nav posts **/
        getShowPostsItem: state => {
            return state.showPostsItem;
        },
        getPostsItemActive: state => {
            return state.postsItemActive;
        },

        /** nav products **/
        getShowProductsItem: state => {
            return state.showProductsItem;
        },
        getProductsItemActive: state => {
            return state.productsItemActive;
        },

        /** nav newsletters **/
        getShowNewslettersItem: state => {
            return state.showNewslettersItem;
        },
        getNewslettersItemActive: state => {
            return state.newslettersItemActive;
        },

        /** nav templates **/
        getShowTemplatesItem: state => {
            return state.showTemplatesItem;
        },
        getTemplatesItemActive: state => {
            return state.templatesItemActive;
        },
    },
    mutations: {
        /** auth **/
        changeUser: (state, callback) => {
            state.user = callback;
            if(state.user.role_id == 1){
                state.admin = true;
            }
        },

        /** show nav bars **/
        changeShowRightBar: state => {
            state.showRightBar = !state.showRightBar;
        },
        changeHideLeftBar: state => {
            state.hideLeftBar = !state.hideLeftBar;
        },

        /** nav settings **/
        changeSettingsItemActive: state => {
            state.settingsItemActive = !state.settingsItemActive;
        },

        /** nav users **/
        changeUsersItemActive: state => {
            state.usersItemActive = !state.usersItemActive;
        },

        /** nav posts **/
        changePostsItemActive: state => {
            state.postsItemActive = !state.postsItemActive;
        },

        /** nav products **/
        changeProductsItemActive: state => {
            state.productsItemActive = !state.productsItemActive;
        },

        /** nav newsletters **/
        changeNewslettersItemActive: state => {
            state.newslettersItemActive = !state.newslettersItemActive;
        },

        /** nav templates **/
        changeTemplatesItemActive: state => {
            state.templatesItemActive = !state.templatesItemActive;
        },
    },
    actions: {
        /** auth **/
        changeUser: (context, callback) => {
            context.commit('changeUser', callback);
        },

        /** show nav bars **/
        changeShowRightBar: context => {
            context.commit('changeShowRightBar');
        },
        changeHideLeftBar: context => {
            context.commit('changeHideLeftBar');
        },

        /** nav settings **/
        changeSettingsItemActive: context => {
            context.commit('changeSettingsItemActive');
        },

        /** nav users **/
        changeUsersItemActive: context => {
            context.commit('changeUsersItemActive');
        },

        /** nav posts **/
        changePostsItemActive: context => {
            context.commit('changePostsItemActive');
        },

        /** nav products **/
        changeProductsItemActive: context => {
            context.commit('changeProductsItemActive');
        },

        /** nav newsletters **/
        changeNewslettersItemActive: context => {
            context.commit('changeNewslettersItemActive');
        },

        /** nav templates **/
        changeTemplatesItemActive: context => {
            context.commit('changeTemplatesItemActive');
        },
    }
});