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

        /** nav orders **/
        showOrdersItem: true,
        ordersItemActive: false,

        /** search product **/
        searchProduct: {
            text: '',
            list: 0,
            page: 1,
        },

        /** search category **/
        searchCategory: {
            text: '',
            list: 0,
            page: 1,
        },

        /** search brand **/
        searchBrand: {
            text: '',
            page: 1,
        },

        /** search attribute **/
        searchAttribute: {
            text: '',
            list: 0,
            page: 1,
        },

        /** search post **/
        searchPost: {
            text: '',
            list: 0,
            page: 1,
        },

        /** search client **/
        searchClient: {
            text: '',
            page: 1,
        },
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

        /** nav orders **/
        getShowOrdersItem: state => {
            return state.showOrdersItem;
        },
        getOrdersItemActive: state => {
            return state.ordersItemActive;
        },

        /** search product **/
        getSearchProduct: state => {
            return state.searchProduct;
        },

        /** search category **/
        getSearchCategory: state => {
            return state.searchCategory;
        },

        /** search brand **/
        getSearchBrand: state => {
            return state.searchBrand;
        },

        /** search attribute **/
        getSearchAttribute: state => {
            return state.searchAttribute;
        },

        /** search post **/
        getSearchPost: state => {
            return state.searchPost;
        },

        /** search client **/
        getSearchClient: state => {
            return state.searchClient;
        },
    },
    mutations: {
        /** auth **/
        changeUser: (state, callback) => {
            state.user = callback;
            if(state.user.role_id == 2){
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

        /** nav orders **/
        changeOrdersItemActive: state => {
            state.ordersItemActive = !state.ordersItemActive;
        },

        /** search product **/
        changeSearchProduct: (state, data) => {
            state.searchProduct = data;
        },
        changeSearchProductPage: (state, data) => {
            state.searchProduct.page = data;
        },

        /** search category **/
        changeSearchCategory: (state, data) => {
            state.searchCategory = data;
        },
        changeSearchCategoryPage: (state, data) => {
            state.searchCategory.page = data;
        },

        /** search brand **/
        changeSearchBrand: (state, data) => {
            state.searchBrand = data;
        },
        changeSearchBrandPage: (state, data) => {
            state.searchBrand.page = data;
        },

        /** search attribute **/
        changeSearchAttribute: (state, data) => {
            state.searchAttribute = data;
        },
        changeSearchAttributePage: (state, data) => {
            state.searchAttribute.page = data;
        },

        /** search post **/
        changeSearchPost: (state, data) => {
            state.searchPost = data;
        },
        changeSearchPostPage: (state, data) => {
            state.searchPost.page = data;
        },

        /** search client **/
        changeSearchClient: (state, data) => {
            state.searchClient = data;
        },
        changeSearchClientPage: (state, data) => {
            state.searchClient.page = data;
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

        /** nav orders **/
        changeOrdersItemActive: context => {
            context.commit('changeOrdersItemActive');
        },

        /** search products **/
        changeSearchProduct: (context, data) => {
            context.commit('changeSearchProduct', data);
        },
        changeSearchProductPage: (context, data) => {
            context.commit('changeSearchProductPage', data);
        },

        /** search category **/
        changeSearchCategory: (context, data) => {
            context.commit('changeSearchCategory', data);
        },
        changeSearchCategoryPage: (context, data) => {
            context.commit('changeSearchCategoryPage', data);
        },

        /** search brand **/
        changeSearchBrand: (context, data) => {
            context.commit('changeSearchBrand', data);
        },
        changeSearchBrandPage: (context, data) => {
            context.commit('changeSearchBrandPage', data);
        },

        /** search attribute **/
        changeSearchAttribute: (context, data) => {
            context.commit('changeSearchAttribute', data);
        },
        changeSearchAttributePage: (context, data) => {
            context.commit('changeSearchAttributePage', data);
        },

        /** search post **/
        changeSearchPost: (context, data) => {
            context.commit('changeSearchPost', data);
        },
        changeSearchPostPage: (context, data) => {
            context.commit('changeSearchPostPage', data);
        },

        /** search client **/
        changeSearchClient: (context, data) => {
            context.commit('changeSearchClient', data);
        },
        changeSearchClientPage: (context, data) => {
            context.commit('changeSearchClientPage', data);
        },
    }
});