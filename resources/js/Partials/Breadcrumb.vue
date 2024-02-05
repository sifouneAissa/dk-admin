[<script>
    import {router} from "@inertiajs/vue3";

    export default {
        data() {
            return {
            };
        },
        mounted() {
            console.log(this.$page.props.breadcrumb.header);
        },
        methods : {
            goTo(routeName){
                if(!routeName) router.reload();
                else
                    router.visit(routeName);
            }
        },
        computed : {
            breadcrumb() {
                return this.$page.props.breadcrumb;
            },
            title() {
                return this.activeHeader ? this.activeHeader?.title : this.header?.title;
            },
            activeHeader(){
                return this.breadcrumb?.active_header;
            },
            header(){
                return this.breadcrumb?.header;
            },
        }
    }
</script>]

<template>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" @click="goTo(header?.link)">{{header?.title}}</a></li>
                        <li v-if="activeHeader" class="breadcrumb-item active">{{activeHeader?.title}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</template>
