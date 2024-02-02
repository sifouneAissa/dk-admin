<script>
    export default {
        data() {
            return {
            };
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
            }
        }
    }
</script>

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
                        <li class="breadcrumb-item"><a href="{{header.link}}">{{header?.title}}</a></li>
                        <li v-if="activeHeader" class="breadcrumb-item active">{{activeHeader?.title}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</template>
