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
        { path: "/users/change-password", component: require('./components/users/UserChangePassword.vue'), meta: { forAdmin: true } },

        { path: "/blogs", component: require('./components/blogs/BlogList.vue'), meta: { forAdmin: true } },
        { path: "/blogs/create", component: require('./components/blogs/BlogCreate.vue'), meta: { forAdmin: true } },
        { path: "/blogs/:id/edit", component: require('./components/blogs/BlogEdit.vue'), meta: { forAdmin: true } },

        { path: "/posts", component: require('./components/posts/PostList.vue'), meta: { forAdmin: true } },
        { path: "/posts/create", component: require('./components/posts/PostCreate.vue'), meta: { forAdmin: true } },
        { path: "/posts/:id/edit", component: require('./components/posts/PostEdit.vue'), meta: { forAdmin: true } },
        { path: "/posts/:id/products", component: require('./components/posts/PostProducts.vue'), meta: { forAdmin: true } },

        { path: "/brands", component: require('./components/brands/BrandList.vue'), meta: { forAdmin: true } },
        { path: "/brands/create", component: require('./components/brands/BrandCreate.vue'), meta: { forAdmin: true } },
        { path: "/brands/:id/edit", component: require('./components/brands/BrandEdit.vue'), meta: { forAdmin: true } },

        { path: "/collections", component: require('./components/collections/CollectionList.vue'), meta: { forAdmin: true } },
        { path: "/collections/create", component: require('./components/collections/CollectionCreate.vue'), meta: { forAdmin: true } },
        { path: "/collections/:id/edit", component: require('./components/collections/CollectionEdit.vue'), meta: { forAdmin: true } },

        { path: "/properties", component: require('./components/properties/PropertyList.vue'), meta: { forAdmin: true } },
        { path: "/properties/create", component: require('./components/properties/PropertyCreate.vue'), meta: { forAdmin: true } },
        { path: "/properties/:id/edit", component: require('./components/properties/PropertyEdit.vue'), meta: { forAdmin: true } },

        { path: "/attributes", component: require('./components/attributes/AttributeList.vue'), meta: { forAdmin: true } },
        { path: "/attributes/create", component: require('./components/attributes/AttributeCreate.vue'), meta: { forAdmin: true } },
        { path: "/attributes/:id/edit", component: require('./components/attributes/AttributeEdit.vue'), meta: { forAdmin: true } },

        { path: "/categories", component: require('./components/categories/CategoryList.vue'), meta: { forAdmin: true } },
        { path: "/categories/create", component: require('./components/categories/CategoryCreate.vue'), meta: { forAdmin: true } },
        { path: "/categories/sort", component: require('./components/categories/CategorySort.vue'), meta: { forAdmin: true } },
        { path: "/categories/:id/edit", component: require('./components/categories/CategoryEdit.vue'), meta: { forAdmin: true } },

        { path: "/products", component: require('./components/products/ProductList.vue'), meta: { forAuth: true } },
        { path: "/products/create", component: require('./components/products/ProductCreate.vue'), meta: { forAuth: true } },
        { path: "/products/:id/edit", component: require('./components/products/ProductEdit.vue'), meta: { forAuth: true } },

        { path: "/settings/:id/edit", component: require('./components/settings/SettingEdit.vue'), meta: { forAdmin: true } },

        { path: "/themes", component: require('./components/themes/ThemeList.vue'), meta: { forAdmin: true } },
        { path: "/themes/create", component: require('./components/themes/ThemeCreate.vue'), meta: { forAdmin: true } },
        { path: "/themes/:id/edit", component: require('./components/themes/ThemeEdit.vue'), meta: { forAdmin: true } },

        { path: "/menus", component: require('./components/menus/MenuList.vue'), meta: { forAuth: true } },
        { path: "/menus/create", component: require('./components/menus/MenuCreate.vue'), meta: { forAuth: true } },
        { path: "/menus/:id/edit", component: require('./components/menus/MenuEdit.vue'), meta: { forAuth: true } },
        { path: "/menus/:id/sort", component: require('./components/menus/MenuSort.vue'), meta: { forAdmin: true } },

        { path: "/menu-links/:id", component: require('./components/menuLinks/MenuLinks.vue'), meta: { forAdmin: true } },
        { path: "/menu-links/:id/create", component: require('./components/menuLinks/MenuLinkCreate.vue'), meta: { forAdmin: true } },
        { path: "/menu-links/:id/edit", component: require('./components/menuLinks/MenuLinkEdit.vue'), meta: { forAdmin: true } },

        { path: "/blocks", component: require('./components/blocks/BlockList.vue'), meta: { forAdmin: true } },
        { path: "/blocks/create", component: require('./components/blocks/BlockCreate.vue'), meta: { forAdmin: true } },
        { path: "/blocks/:id/edit", component: require('./components/blocks/BlockEdit.vue'), meta: { forAdmin: true } },

        { path: "/boxes", component: require('./components/boxes/BoxList.vue'), meta: { forAdmin: true } },
        { path: "/boxes/create", component: require('./components/boxes/BoxCreate.vue'), meta: { forAuth: true } },
        { path: "/boxes/:id/edit", component: require('./components/boxes/BoxEdit.vue'), meta: { forAuth: true } },

        { path: "/tags", component: require('./components/tags/TagList.vue'), meta: { forAdmin: true } },
        { path: "/tags/create", component: require('./components/tags/TagCreate.vue'), meta: { forAdmin: true } },
        { path: "/tags/:id/edit", component: require('./components/tags/TagEdit.vue'), meta: { forAdmin: true } },

        { path: "/shop-bars", component: require('./components/shopBars/ShopBarList.vue'), meta: { forAdmin: true } },
        { path: "/shop-bars/create", component: require('./components/shopBars/ShopBarCreate.vue'), meta: { forAdmin: true } },
        { path: "/shop-bars/:id/edit", component: require('./components/shopBars/ShopBarEdit.vue'), meta: { forAdmin: true } },

        { path: "/subscribers", component: require('./components/subscribers/SubscriberList.vue'), meta: { forAdmin: true } },
        { path: "/subscribers/create", component: require('./components/subscribers/SubscriberCreate.vue'), meta: { forAdmin: true } },
        { path: "/subscribers/:id/edit", component: require('./components/subscribers/SubscriberEdit.vue'), meta: { forAdmin: true } },

        { path: "/customers", component: require('./components/customers/CustomerList.vue'), meta: { forAdmin: true } },
        { path: "/customers/create", component: require('./components/customers/CustomerCreate.vue'), meta: { forAdmin: true } },
        { path: "/customers/:id/edit", component: require('./components/customers/CustomerEdit.vue'), meta: { forAdmin: true } },

        { path: "/shopping-carts", component: require('./components/shoppingCart/ShoppingCartList.vue'), meta: { forAuth: true } },
        { path: "/shopping-carts/:id/edit", component: require('./components/shoppingCart/ShoppingCartEdit.vue'), meta: { forAuth: true } },

        { path: "/brand-links/:brand", component: require('./components/brandLinks/BrandLinkList.vue'), meta: { forAdmin: true } },
        { path: "/brand-links/:brand/create", component: require('./components/brandLinks/BrandLinkCreate.vue'), meta: { forAuth: true } },
        { path: "/brand-links/:brand/edit/:id", component: require('./components/brandLinks/BrandLinkEdit.vue'), meta: { forAuth: true } },

        { path: "/currencies", component: require('./components/currencies/CurrencyList.vue'), meta: { forAdmin: true } },
        { path: "/currencies/create", component: require('./components/currencies/CurrencyCreate.vue'), meta: { forAdmin: true } },
        { path: "/currencies/:id/edit", component: require('./components/currencies/CurrencyEdit.vue'), meta: { forAdmin: true } },

        { path: "/clients", component: require('./components/clients/ClientList.vue'), meta: { forAdmin: true } },
        { path: "/clients/create", component: require('./components/clients/ClientCreate.vue'), meta: { forAdmin: true } },
        { path: "/clients/:id/edit", component: require('./components/clients/ClientEdit.vue'), meta: { forAdmin: true } },
        { path: "/clients/:id/category", component: require('./components/clients/ClientCategory.vue'), meta: { forAdmin: true } },

        { path: "/client-bars/:id", component: require('./components/clientBars/BarList.vue'), meta: { forAdmin: true } },
    ],

    linkActiveClass: 'active',
});