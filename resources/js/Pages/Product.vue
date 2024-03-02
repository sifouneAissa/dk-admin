<template>
    <Layout>
        <ProductDatatable  />
    </Layout>
</template>
  
<script>

import Layout from '@/Pages/Layout.vue';
import ProductDatatable from '@/Pages/Products/ProductDatatable.vue';


export default {
    components: {
        Layout,ProductDatatable
    }
};
</script>
  