<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CustomDatatable from '@/Components/Common/CustomDatatable.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Product" />
    <AppLayout title="Product">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <CustomDatatable :header="'Manage Proudcts'"   />
                </div>
            </div>
        </div>

    </AppLayout>
</template>
