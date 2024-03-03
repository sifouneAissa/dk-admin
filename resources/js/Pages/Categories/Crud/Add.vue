<template>
    <Layout>
        <Toast />
        <Card>
            <template #title>{{ title }}</template>

            <template #content>
                <p class="m-0">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error
                    repudiandae
                    numquam deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis
                    esse, cupiditate neque
                    quas!
                </p>
            </template>
        </Card>
        <Divider />
        <Card>

            <template #title>General</template>

            <template #content>
                <form @submit.prevent="submit">
                    <Divider />
                    <FloatLabel>
                        <InputText type="text" v-model="name" inputId="ac" :invalid="hasErrors && v$.name.$invalid" />
                        <label for="ac">Name</label>
                    </FloatLabel>
                    <Divider />
                    <FloatLabel>
                        <Textarea v-model="description" inputId="ac" rows="5" cols="30"
                            :invalid="hasErrors && v$.name.$invalid" />
                        <label for="ac">Description</label>
                    </FloatLabel>
                    <Divider />
                    <div class="flex justify-content-center">

                    </div>
                    <FloatLabel class="w-full card flex justify-content-center col-4">
                        <TreeSelect v-model="parent_id" :options="categories" placeholder="Select Category"
                            class="w-full" />
                        <label>Select Category</label>
                    </FloatLabel>
                    <Button label="Submit" type="submit" class="float-right" :disabled="form.processing" />
                </form>
            </template>
        </Card>
    </Layout>
</template>

<script>

import Layout from '@/Pages/Layout.vue';
import Card from 'primevue/card';
import Divider from 'primevue/divider';
import FloatLabel from 'primevue/floatlabel';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';
import { useVuelidate } from '@vuelidate/core'
import { required, email } from '@vuelidate/validators'
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
import Toast from 'primevue/toast';
import 'primevue/resources/themes/aura-light-green/theme.css'
import TreeSelect from 'primevue/treeselect';
import { CategoryService } from './../CategoryService';




export default {
    setup() {
        return { v$: useVuelidate(), toast$: useToast() }
    },
    components: {
        Layout,
        Card,
        Toast,
        Divider,
        FloatLabel,
        InputText,
        Textarea,
        Button,
        TreeSelect
    },
    props: ['breadcrumb', 'message'],
    mounted() {
        CategoryService.getSelect().then((data) => {
            this.categories = data;
        });

    },
    computed: {
        title() {
            return this.breadcrumb.active_header.title;
        },
        hasErrors() {
            return this.v$.$errors.length > 0;
        }
    },
    methods: {
        getKeyByValue(object, targetValue) {
            for (const key in object) {
                if (object.hasOwnProperty(key) && object[key] === targetValue) {
                    return key;
                }
            }
            return null; // Return null if the value is not found
        },
        async submit() {
            const result = await this.v$.$validate()
            if (result) {
                let value = null;
                if (this.parent_id) {
                        value = this.getKeyByValue(this.parent_id, true);
                }
                this.form.transform(data => ({
                    name: this.name,
                    description: this.description,
                    parent_id: value
                })).post(route('admin.category.store'), {
                    onSuccess: (data) => {
                        this.toast$.add({ severity: 'success', summary: this.$page.props.flash.message, life: 3000 });
                        this.$inertia.visit(route('admin.category.index'));
                    },
                    onError: () => {
                        this.toast$.add({ severity: 'error', summary: 'Error Message', detail: 'Message Content', life: 3000 });
                    }
                });
            }
        }
    },

    data() {
        return {
            categories: null,
            name: '',
            description: '',
            parent_id: '',
            form: useForm({
            }),
        }
    },

    validations: {
        name: { required },
        description: { required },
    },
};
</script>