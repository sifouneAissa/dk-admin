
<template>
    <div class="card p-fluid">
        <Toolbar class="mb-4">
            <template #start>
                <Button label="New" icon="pi pi-plus" severity="success" class="mr-2" @click="openNew" />
                <Button label="Delete" icon="pi pi-trash" severity="danger" @click="confirmDeleteSelected"
                    :disabled="!selectedProducts || !selectedProducts.length" />
            </template>
            <template #end>
                <FileUpload mode="basic" accept="image/*" :maxFileSize="1000000" label="Import" chooseLabel="Import"
                    class="mr-2 inline-block" />
                <Button label="Export" icon="pi pi-upload" severity="help" @click="exportCSV($event)" />
            </template>
        </Toolbar>


        <DataTable :rowsPerPageOptions="rows" :value="customers" lazy paginator :first="first" :rows="perPage"
            v-model:filters="filters" ref="dt" dataKey="id" :totalRecords="totalRecords" :loading="loading"
            @page="onPage($event)" @sort="onSort($event)" @filter="onFilter($event)" filterDisplay="row"
            :globalFilterFields="['name', 'description']" v-model:selection="selectedProducts" :selectAll="selectAll"
            @select-all-change="onSelectAllChange" @row-select="onRowSelect" @row-unselect="onRowUnselect"
            tableStyle="min-width: 75rem">

            <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
            <Column field="name" header="Name" filterMatchMode="startsWith" sortable>
                <template #filter="{ filterModel, filterCallback }">
                    <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                        class="p-column-filter" placeholder="Search" />
                </template>
            </Column>
            <Column field="description" header="Description" filterField="description" filterMatchMode="contains" sortable>
                <template #body="{ data }">
                    <div class="flex align-items-center gap-2">
                        <div>{{ data.description }}</div>
                    </div>
                </template>
                <!-- <template #filter="{ filterModel, filterCallback }">
                    <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                        class="p-column-filter" placeholder="Search" />
                </template> -->
            </Column>


            <Column :exportable="false" style="min-width:8rem">
                <template #body="slotProps">
                    <Button icon="pi pi-pencil" outlined rounded class="mr-2" @click="editProduct(slotProps.data)" />
                    <Button icon="pi pi-trash" outlined rounded severity="danger"
                        @click="confirmDeleteProduct(slotProps.data)" />
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import { ProductService } from './ProductService';

import { ref, onMounted } from 'vue';
import { FilterMatchMode } from 'primevue/api';
import { useToast } from 'primevue/usetoast';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';
import FileUpload from 'primevue/fileupload';
import Toolbar from 'primevue/toolbar';
import Button from 'primevue/button';
import Tag from 'primevue/tag';
import ConfirmDialog from 'primevue/confirmdialog';
import Dialog from 'primevue/dialog';
import InputNumber from 'primevue/inputnumber';
import RadioButton from 'primevue/radiobutton';
import Dropdown from 'primevue/dropdown';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import 'primeicons/primeicons.css';

export default {
    components: {
        DataTable, Column, ColumnGroup, Row, FileUpload, Toolbar, Button, IconField, InputIcon, InputText
    },

    // props: {
    //     // Define your props here
    //     prop1: {
    //         type: String,
    //         required: true
    //     },
    //     prop2: {
    //         type: Number,
    //         default: 42
    //     },
    //     // Add more props as needed
    // },
    // Other component options (methods, computed, etc.) can go here
    data() {
        return {
            loading: false,
            totalRecords: 0,
            customers: null,
            selectedProducts: null,
            selectAll: false,
            first: 0,
            filters: {
                'name': { value: '', matchMode: 'contains' },
                'description': { value: '', matchMode: 'contains' },
                'global': { value: '' }
            },
            lazyParams: {},
            columns: [
                { field: 'name', header: 'Name' },
                { field: 'description', header: 'Description' },
            ]
        }
    },
    mounted() {
        this.loading = true;

        this.lazyParams = {
            first: 0,
            rows: 10,
            sortField: null,
            sortOrder: null,
            filters: this.filters
        }; 

        this.loadLazyData();
    },
    computed : {
            rows () {
                return this.$page.props.datatable.rows;
            },
            perPage () {
                return this.$page.props.datatable.perPage;
            }
    },
    methods: {
        loadLazyData() {
            this.loading = true;
            this.lazyParams = { ...this.lazyParams, first: event?.first || this.first };

            setTimeout(() => {
                ProductService.getProducts({ lazyEvent: JSON.stringify(this.lazyParams) }).then((data) => {
                    this.customers = data.data;
                    this.totalRecords = data.total;
                    this.loading = false;
                });
            }, Math.random() * 1000 + 250);
        },
        onPage(event) {
            this.lazyParams = event;
            console.log(event);
            this.loadLazyData(event);
        },
        onSort(event) {
            this.lazyParams = event;
            this.loadLazyData(event);
        },
        onFilter(event) {
            this.lazyParams.filters = this.filters;
            this.loadLazyData(event);
        },
        onSelectAllChange(event) {
            const selectAll = event.checked;

            if (selectAll) {
                ProductService.getProducts().then(data => {
                    this.selectAll = true;
                    this.selectedProducts = data.customers;
                });
            }
            else {
                this.selectAll = false;
                this.selectedProducts = [];
            }
        },
        onRowSelect() {
            this.selectAll = this.selectedProducts.length === this.totalRecords
        },
        onRowUnselect() {
            this.selectAll = false;
        },
        openNew(){
            this.$inertia.visit(route('admin.product.create'));
        }
    }
} 
</script>