<script setup>
import { ref } from 'vue';
import { usePage,Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Footer from '@/Layouts/Footer.vue';
import Sidebar from '@/Partials/Sidebar.vue';
import Navbar from '@/Partials/Navbar.vue';
import Breadcrumb from '@/Partials/Breadcrumb.vue';

defineProps({
    title: String,
});

const page = usePage();

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};


const isAuthenticated =  ref(page.props.auth.user !== null);

</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100">
            <Navbar v-if="isAuthenticated" />
            <Sidebar v-if="isAuthenticated" />
            <!-- Page Content -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <Breadcrumb :breadcrumb="[]" />

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        <main>
                            <slot />
                        </main>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
        </div>
        <Footer />
    </div>
</template>
