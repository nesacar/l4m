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

        { path: "/users", component: require('./components/users/UserList.vue'), meta: { forAdmin: true } },
        { path: "/users/create", component: require('./components/users/UserCreate.vue'), meta: { forAdmin: true } },
        { path: "/users/:id/edit", component: require('./components/users/UserEdit.vue'), meta: { forAdmin: true } },
        { path: "/users/change-password", component: require('./components/users/UserChangePassword.vue'), meta: { forAuth: true } },

        { path: "/blogs", component: require('./components/blogs/BlogList.vue'), meta: { forAuth: true } },
        { path: "/blogs/create", component: require('./components/blogs/BlogCreate.vue'), meta: { forAuth: true } },
        { path: "/blogs/:id/edit", component: require('./components/blogs/BlogEdit.vue'), meta: { forAuth: true } },

        { path: "/posts", component: require('./components/posts/PostList.vue'), meta: { forAuth: true } },
        { path: "/posts/create", component: require('./components/posts/PostCreate.vue'), meta: { forAuth: true } },
        { path: "/posts/:id/edit", component: require('./components/posts/PostEdit.vue'), meta: { forAuth: true } },
        { path: "/posts/:id/products", component: require('./components/posts/PostProducts.vue'), meta: { forAuth: true } },

        { path: "/brands", component: require('./components/brands/BrandList.vue'), meta: { forAuth: true } },
        { path: "/brands/create", component: require('./components/brands/BrandCreate.vue'), meta: { forAuth: true } },
        { path: "/brands/:id/edit", component: require('./components/brands/BrandEdit.vue'), meta: { forAuth: true } },

        { path: "/collections", component: require('./components/collections/CollectionList.vue'), meta: { forAuth: true } },
        { path: "/collections/create", component: require('./components/collections/CollectionCreate.vue'), meta: { forAuth: true } },
        { path: "/collections/:id/edit", component: require('./components/collections/CollectionEdit.vue'), meta: { forAuth: true } },

        { path: "/sets", component: require('./components/sets/SetList.vue'), meta: { forAuth: true } },
        { path: "/sets/create", component: require('./components/sets/SetCreate.vue'), meta: { forAuth: true } },
        { path: "/sets/:id/edit", component: require('./components/sets/SetEdit.vue'), meta: { forAuth: true } },

        { path: "/properties", component: require('./components/properties/PropertyList.vue'), meta: { forAuth: true } },
        { path: "/properties/create", component: require('./components/properties/PropertyCreate.vue'), meta: { forAuth: true } },
        { path: "/properties/:id/edit", component: require('./components/properties/PropertyEdit.vue'), meta: { forAuth: true } },

        { path: "/attributes", component: require('./components/attributes/AttributeList.vue'), meta: { forAuth: true } },
        { path: "/attributes/create", component: require('./components/attributes/AttributeCreate.vue'), meta: { forAuth: true } },
        { path: "/attributes/:id/edit", component: require('./components/attributes/AttributeEdit.vue'), meta: { forAuth: true } },

        { path: "/categories", component: require('./components/categories/CategoryList.vue'), meta: { forAuth: true } },
        { path: "/categories/create", component: require('./components/categories/CategoryCreate.vue'), meta: { forAuth: true } },
        { path: "/categories/:id/edit", component: require('./components/categories/CategoryEdit.vue'), meta: { forAuth: true } },

        { path: "/products", component: require('./components/products/ProductList.vue'), meta: { forAuth: true } },
        { path: "/products/create", component: require('./components/products/ProductCreate.vue'), meta: { forAuth: true } },
        { path: "/products/:id/edit", component: require('./components/products/ProductEdit.vue'), meta: { forAuth: true } },

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

        { path: "/blocks", component: require('./components/blocks/BlockList.vue'), meta: { forAuth: true } },
        { path: "/blocks/create", component: require('./components/blocks/BlockCreate.vue'), meta: { forAuth: true } },
        { path: "/blocks/:id/edit", component: require('./components/blocks/BlockEdit.vue'), meta: { forAuth: true } },

        { path: "/boxes", component: require('./components/boxes/BoxList.vue'), meta: { forAuth: true } },
        { path: "/boxes/create", component: require('./components/boxes/BoxCreate.vue'), meta: { forAuth: true } },
        { path: "/boxes/:id/edit", component: require('./components/boxes/BoxEdit.vue'), meta: { forAuth: true } },

        { path: "/tags", component: require('./components/tags/TagList.vue'), meta: { forAuth: true } },
        { path: "/tags/create", component: require('./components/tags/TagCreate.vue'), meta: { forAuth: true } },
        { path: "/tags/:id/edit", component: require('./components/tags/TagEdit.vue'), meta: { forAuth: true } },

        { path: "/shop-bars", component: require('./components/shopBars/ShopBarList.vue'), meta: { forAuth: true } },
        { path: "/shop-bars/create", component: require('./components/shopBars/ShopBarCreate.vue'), meta: { forAuth: true } },
        { path: "/shop-bars/:id/edit", component: require('./components/shopBars/ShopBarEdit.vue'), meta: { forAuth: true } },

        { path: "/subscribers", component: require('./components/subscribers/SubscriberList.vue'), meta: { forAuth: true } },
        { path: "/subscribers/create", component: require('./components/subscribers/SubscriberCreate.vue'), meta: { forAuth: true } },
        { path: "/subscribers/:id/edit", component: require('./components/subscribers/SubscriberEdit.vue'), meta: { forAuth: true } },

        { path: "/customers", component: require('./components/customers/CustomerList.vue'), meta: { forAuth: true } },
        { path: "/customers/create", component: require('./components/customers/CustomerCreate.vue'), meta: { forAuth: true } },
        { path: "/customers/:id/edit", component: require('./components/customers/CustomerEdit.vue'), meta: { forAuth: true } },

        { path: "/shopping-carts", component: require('./components/shoppingCart/ShoppingCartList.vue'), meta: { forAuth: true } },
        { path: "/shopping-carts/:id/edit", component: require('./components/shoppingCart/ShoppingCartEdit.vue'), meta: { forAuth: true } },

        { path: "/brand-links/:brand", component: require('./components/brandLinks/BrandLinkList.vue'), meta: { forAuth: true } },
        { path: "/brand-links/:brand/create", component: require('./components/brandLinks/BrandLinkCreate.vue'), meta: { forAuth: true } },
        { path: "/brand-links/:brand/edit/:id", component: require('./components/brandLinks/BrandLinkEdit.vue'), meta: { forAuth: true } },
    ],

    linkActiveClass: 'active',
});