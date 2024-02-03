<script>
    import {Head, Link, router} from '@inertiajs/vue3';

    export default {
        props : {
            item : Object
        },
        data() {
            return {

            };
        },
        mounted() {

        },
        methods : {
            visitRoute(){
                if(this.childrenEmpty)
                router.visit(this.routeUrl);
            }
        },
        computed : {
            title () {
                return this.item.text;
            },
            icon () {
                return this.item.icon;
            },
            routeName () {
                return this.item.route;
            },
            children(){
                return this.item.children;
            },
            childrenEmpty(){
                return this.children.length === 0;
            },
            routeUrl(){
                return !this.childrenEmpty ? '#' : this.route(this.routeName);
            },
            isCurrent(){
                return this.route().current(this.routeName);
            }
        }
    }
</script>

<template>
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li :class="'nav-item ' + (!childrenEmpty ? 'menu-open' : '')">
        <a @click="visitRoute()" href="#" :class="'nav-link ' + (isCurrent ? 'active' : '') ">
            <i :class="'nav-icon fas ' + icon"></i>
            <p>
                {{title}}
                <i v-if="!childrenEmpty" class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul :class="'nav ' + (!childrenEmpty ? 'nav-treeview' : '') ">
            <NavItem v-for="(item, key) in children" :key="key" :item="item" />
        </ul>

    </li>
</template>
