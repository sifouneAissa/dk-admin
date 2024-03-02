<script >
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout
    },
    computed : {
        title () {
            return this.breadcrumb.active_header.title;
        }, 
        breadcrumb () {
            return this.$page.props.breadcrumb;
        }
    }
};

</script>

<template>
    <Head :title="title" />
    <AppLayout :title="title">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <main>
                        <slot />
                    </main>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
