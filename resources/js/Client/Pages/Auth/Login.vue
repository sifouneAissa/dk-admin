<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Client/Layouts/AppLayout.vue';
    import Message from 'primevue/message';

    defineProps({
        canResetPassword: Boolean,
        status: String,
    });

    const form = useForm({
        email: '',
        password: '',
        is_admin: false,
        remember: false,
    });


    const formRegister = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false,
    });


    const submitRegister = () => {
        formRegister.post(route('register'), {
            onFinish: () => formRegister.reset('password', 'password_confirmation'),
        });
    };

    const submit = () => {
        form.transform(data => ({
            ...data,
            remember: form.remember ? 'on' : '',
        })).post(route('login'), {
            onFinish: (e) =>  {
                form.reset('password');
                console.log(form.errors.email);
            },
        });
    };
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <section class="login-wrapper login-wrapper-page">
            <div class="container">

                <header class="hidden">
                    <h3 class="h3 title">Sign in</h3>
                </header>

                <div class="row">

                    <!-- === left content === -->

                    <div class="col-md-6 col-md-offset-3">

                        <!-- === login-wrapper === -->

                        <div class="login-wrapper">

                            <div class="white-block">

                                <!--signin-->

                                <div class="login-block login-block-signin">

                                    <div class="h4">Sign in <a href="javascript:void(0);" class="btn btn-main btn-xs btn-register pull-right">create an account</a></div>

                                    <hr />

                                    <div class="row">
                                        <form  @submit.prevent="submit" >
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="email" v-model="form.email" class="form-control" placeholder="Email">
                                                </div>
                                                <Message  v-if="form.errors.email" severity="error">{{ form.errors.email }}</Message>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="password" required v-model="form.password" class="form-control" placeholder="Password">
                                                </div>
                                            </div>

                                            <div class="col-xs-6">
                                            <span class="checkbox">
                                                <input v-model="form.remember" type="checkbox" id="checkBoxId3">
                                                <label for="checkBoxId3">Remember me</label>
                                            </span>
                                            </div>

                                            <div class="col-xs-6 text-right">
                                                <button type="submit" class="btn btn-main" :disabled="form.processing" >Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!--/signin-->
                                <!--signup-->

                                <div class="login-block login-block-signup">

                                    <div class="h4">Register now <a href="javascript:void(0);" class="btn btn-main btn-xs btn-login pull-right">Log in</a></div>

                                    <hr />

                                    <div class="row">
                                        <form @submit.prevent="submitRegister">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input required type="text" v-model="formRegister.name" class="form-control" placeholder="Name: *">
                                                </div>
                                                <Message  v-if="formRegister.errors.name" severity="error">{{ formRegister.errors.name }}</Message>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input required type="email" v-model="formRegister.email" class="form-control" placeholder="Email: *">
                                                </div>
                                                <Message  v-if="formRegister.errors.email" severity="error">{{ formRegister.errors.email }}</Message>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input  type="password" required v-model="formRegister.password" class="form-control" placeholder="Password">
                                                </div>
                                                <Message  v-if="formRegister.errors.password" severity="error">{{ formRegister.errors.password }}</Message>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="password" required v-model="formRegister.password_confirmation" class="form-control" placeholder="Password Confirm">
                                                </div>
                                                <Message  v-if="formRegister.errors.password_confirmation" severity="error">{{ formRegister.errors.password_confirmation }}</Message>
                                            </div>

                                            <div class="col-md-12">
                                                <hr />
                                                <span class="checkbox">
                                                <input type="checkbox" id="checkBoxId1">
                                                <label for="checkBoxId1">I have read and accepted the <a href="#">terms</a>, as well as read and understood our terms of <a href="#">business contidions</a></label>
                                            </span>
                                                <span class="checkbox">
                                                <input type="checkbox" id="checkBoxId2">
                                                <label for="checkBoxId2">Subscribe to exciting newsletters and great tips</label>
                                            </span>
                                                <hr />
                                            </div>

                                            <div class="col-xs-6 text-right">
                                                <button type="submit" class="btn btn-main" :disabled="form.processing" >Create Account</button>
                                            </div>
                                        </form>

                                    </div>
                                </div> <!--/signup-->
                            </div>
                        </div> <!--/login-wrapper-->
                    </div> <!--/col-md-6-->

                </div>

            </div>
        </section>
    </AppLayout>

<!--    <AuthenticationCard>-->
<!--        <template #logo>-->
<!--            <AuthenticationCardLogo />-->
<!--        </template>-->

<!--        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">-->
<!--            {{ status }}-->
<!--        </div>-->

<!--        <form @submit.prevent="submit">-->
<!--            <div>-->
<!--                <InputLabel for="email" value="Email" />-->
<!--                <TextInput-->
<!--                    id="email"-->
<!--                    v-model="form.email"-->
<!--                    type="email"-->
<!--                    class="mt-1 block w-full"-->
<!--                    required-->
<!--                    autofocus-->
<!--                    autocomplete="username"-->
<!--                />-->
<!--                <InputError class="mt-2" :message="form.errors.email" />-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <InputLabel for="password" value="Password" />-->
<!--                <TextInput-->
<!--                    id="password"-->
<!--                    v-model="form.password"-->
<!--                    type="password"-->
<!--                    class="mt-1 block w-full"-->
<!--                    required-->
<!--                    autocomplete="current-password"-->
<!--                />-->
<!--                <InputError class="mt-2" :message="form.errors.password" />-->
<!--            </div>-->

<!--            <div class="block mt-4">-->
<!--                <label class="flex items-center">-->
<!--                    <Checkbox v-model:checked="form.remember" name="remember" />-->
<!--                    <span class="ms-2 text-sm text-gray-600">Remember me</span>-->
<!--                </label>-->
<!--            </div>-->

<!--            <div class="flex items-center justify-end mt-4">-->
<!--                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">-->
<!--                    Forgot your password?-->
<!--                </Link>-->

<!--                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
<!--                    Log in-->
<!--                </PrimaryButton>-->
<!--            </div>-->
<!--        </form>-->
<!--    </AuthenticationCard>-->
</template>
