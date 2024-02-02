<template>
    <!-- ========================  Main header ======================== -->
    <section class="main-header" style="background-image:url(/dist/assets/images/gallery-2.jpg)">
        <header>
            <div class="container text-center">
                <h2 class="h2 title">{{ page.props.mainheader }}</h2>
                <ol class="breadcrumb breadcrumb-inverted">
                    <li><a href="#" @click="router.visit('/')"><span class="icon icon-home"></span></a></li>
                    <li><a class="active" @click="router.visit('/dashboard')">{{ page.props.subheader }}</a></li>
                </ol>
            </div>
        </header>
    </section>
</template>

<script setup>
    import {Head, Link, router,usePage} from '@inertiajs/vue3';
    // Use usePage to access the page object
    const page = usePage();

</script>

<style scoped>

</style>
