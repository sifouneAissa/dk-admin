<script>
import { Head, Link, router } from '@inertiajs/vue3';

export default {
    props: {
        item: Object
    },
    data() {
        return {};
    },
    mounted() {
        console.log(this.childrenRoutes);
    },
    methods: {
        visitRoute() {
            if (this.childrenEmpty)
                router.visit(this.routeUrl);
        }, 
        flattenMenuItems(menuItems) {
            let flattenedItems = [];

            function flatten(items) {
                items.forEach(item => {
                    flattenedItems.push(item);
                    if (item.children && item.children.length > 0) {
                        flatten(item.children);
                    }
                });
            }

            flatten(menuItems);
            return flattenedItems;
        }
    },
    computed: {
        title() {
            return this.item.text;
        },
        icon() {
            return this.item.icon;
        },
        routeName() {
            return this.item.route;
        },
        children() {
            return this.item.children;
        },
        childrenEmpty() {
            return this.children.length === 0;
        },
        routeUrl() {
            return !this.childrenEmpty ? '#' : this.route(this.routeName);
        },
        isCurrent() {
            return this.route().current(this.routeName);
        },
        hasActive() {
            let arr = this.flattenMenuItems(this.children);
            if(arr) {
                return arr.some(item => this.route().current(item.route));
            }
            return false;
        },
        per() {
            return this.item.can;
        },
        can() {
            return this.$page.props.permissions.some((item) => item === this.per) || !this.per;
        }
    }
}
</script>

<template>
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li v-if="can" :class="'nav-item ' + (!childrenEmpty ? 'menu-open' : '')">
        <a @click="visitRoute()" href="#" :class="'nav-link ' + (isCurrent || hasActive ? 'active' : '')">
            <i :class="'nav-icon fas ' + icon"></i>
            <p>
                {{ title }}
                <i v-if="!childrenEmpty" class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul :class="'nav ' + (!childrenEmpty ? 'nav-treeview' : '')">
            <NavItem v-for="(item, key) in children" :key="key" :item="item" />
        </ul>

    </li>
</template>
