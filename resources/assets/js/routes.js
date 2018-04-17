import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export const router = new VueRouter({
    routes: [
        { path: "/", component: require('./components/home/Home.vue'), meta: { forAuth: true } },
        { path: "/home", component: require('./components/home/Home.vue'), meta: { forAuth: true } },

        { path: "/login", component: require('./components/auth/Login.vue'), meta: { forVisitors: true } },
        { path: "/register", component: require('./components/auth/Register.vue'), meta: { forVisitors: true } },
        { path: "/logout", component: require('./components/auth/Logout.vue'), meta: { forAuth: true } },

        { path: "/users", component: require('./components/users/UserList.vue'), meta: { forAuth: true } },
        { path: "/users/create", component: require('./components/users/UserCreate.vue'), meta: { forAuth: true } },
        { path: "/users/:id/edit", component: require('./components/users/UserEdit.vue'), meta: { forAuth: true } },
        { path: "/users/change-password", component: require('./components/users/UserChangePassword.vue'), meta: { forAuth: true } },

        // { path: "/categories", component: require('./components/categories/CategoryList.vue'), meta: { forAuth: true } },
        // { path: "/categories/create", component: require('./components/categories/CategoryCreate.vue'), meta: { forAuth: true } },
        // { path: "/categories/:id/edit", component: require('./components/categories/CategoryEdit.vue'), meta: { forAuth: true } },
        //
        // { path: "/posts", component: require('./components/posts/PostList.vue'), meta: { forAuth: true } },
        // { path: "/posts/create", component: require('./components/posts/PostCreate.vue'), meta: { forAuth: true } },
        // { path: "/posts/:id/edit", component: require('./components/posts/PostEdit.vue'), meta: { forAuth: true } },
        //
        // { path: "/collections", component: require('./components/collections/CollectionList.vue'), meta: { forAuth: true } },
        // { path: "/collections/create", component: require('./components/collections/CollectionCreate.vue'), meta: { forAuth: true } },
        // { path: "/collections/:id/edit", component: require('./components/collections/CollectionEdit.vue'), meta: { forAuth: true } },
        //
        // { path: "/products", component: require('./components/products/ProductList.vue'), meta: { forAuth: true } },
        // { path: "/products/create", component: require('./components/products/ProductCreate.vue'), meta: { forAuth: true } },
        // { path: "/products/:id/edit", component: require('./components/products/ProductEdit.vue'), meta: { forAuth: true } },

        { path: "/settings/:id/edit", component: require('./components/settings/SettingEdit.vue'), meta: { forAuth: true } },

        { path: "/themes", component: require('./components/themes/ThemeList.vue'), meta: { forAuth: true } },
        { path: "/themes/create", component: require('./components/themes/ThemeCreate.vue'), meta: { forAuth: true } },
        { path: "/themes/:id/edit", component: require('./components/themes/ThemeEdit.vue'), meta: { forAuth: true } },

        { path: "/menus", component: require('./components/menus/MenuList.vue'), meta: { forAuth: true } },
        { path: "/menus/create", component: require('./components/menus/MenuCreate.vue'), meta: { forAuth: true } },
        { path: "/menus/:id/edit", component: require('./components/menus/MenuEdit.vue'), meta: { forAuth: true } },
        { path: "/menus/:id/sort", component: require('./components/menus/MenuSort.vue'), meta: { forAuth: true } },

        { path: "/menu-links/:id", component: require('./components/menuLinks/MenuLinks.vue'), meta: { forAuth: true } },
        { path: "/menu-links/:id/create", component: require('./components/menuLinks/MenuLinkCreate.vue'), meta: { forAuth: true } },
        { path: "/menu-links/:id/edit", component: require('./components/menuLinks/MenuLinkEdit.vue'), meta: { forAuth: true } },

        // { path: "/galleries", component: require('./components/galleries/GalleryList.vue'), meta: { forAuth: true } },
        // { path: "/galleries/create", component: require('./components/galleries/GalleryCreate.vue'), meta: { forAuth: true } },
        // { path: "/galleries/:id/edit", component: require('./components/galleries/GalleryEdit.vue'), meta: { forAuth: true } },
        //
        // { path: "/architects", component: require('./components/architects/ArchitectList.vue'), meta: { forAuth: true } },
        // { path: "/architects/:id/edit", component: require('./components/architects/ArchitectEdit.vue'), meta: { forAuth: true } },
    ],

    linkActiveClass: 'active'
});