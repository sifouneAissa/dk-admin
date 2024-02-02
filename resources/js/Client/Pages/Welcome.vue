<script setup>
    import AppLayout from '@/Client/Layouts/AppLayout.vue';
    import Navbar from '@/Client/Partials/Navbar.vue';
    import HeaderSlider from '@/Client/Partials/HeaderSlider.vue';
    import IconsSlider from '@/Client/Partials/IconsSlider.vue';
    import Products from '@/Client/Partials/Products.vue';
    import Stretcher from '@/Client/Partials/Stretcher.vue';
    import CBanner from '@/Client/Partials/CBanner.vue';
    import Footer from '@/Client/Partials/Footer.vue';
    import Blog from '@/Client/Partials/Blog.vue';
    import Instagram from '@/Client/Partials/Instagram.vue';
    import {Head, Link} from '@inertiajs/vue3';
    import {onMounted} from "vue";

    defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    });

    onMounted(() => {
        const path = '/dist/js/main.js';
        let mainScript = document.createElement('script');
        mainScript.setAttribute('src',path);
        mainScript.setAttribute('id',"mainScript");
        if(document.querySelector(`script[id=mainScript]`) === null )
            document.head.appendChild(mainScript)
    });
</script>
<template>
    <div>

<!--        <div class="page-loader"></div>-->

        <div class="wrapper">

            <!--Use class "navbar-fixed" or "navbar-default" -->
            <!--If you use "navbar-fixed" it will be sticky menu on scroll (only for large screens)-->

            <!-- ======================== Navigation ======================== -->
            <Navbar/>

            <!-- ========================  Header content ======================== -->
            <HeaderSlider/>

            <!-- ========================  Icons slider ======================== -->
            <IconsSlider/>

            <!-- ========================  Products widget ======================== -->
            <Products/>

            <!-- ========================  Stretcher widget ======================== -->
            <Stretcher/>

            <!-- ========================  Blog Block ======================== -->

            <section class="blog blog-block">

                <div class="container">

                    <!-- === blog header === -->

                    <header>
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8 text-center">
                                <h2 class="title">Interior ideas</h2>
                                <div class="text">
                                    <p>Keeping things minimal</p>
                                </div>
                            </div>
                        </div>
                    </header>

                    <div class="row">

                        <!-- === blog item === -->

                        <div class="col-sm-4">
                            <article>
                                <a href="article.html">
                                    <div class="image">
                                        <img src="/dist/assets/images/project-1.jpg" alt=""/>
                                    </div>
                                    <div class="entry entry-block">
                                        <div class="date">28 Mart 2017</div>
                                        <div class="title">
                                            <h2 class="h3">Creating the Perfect Gallery Wall </h2>
                                        </div>
                                        <div class="description">
                                            <p>
                                                You’ve finally reached this point in your life- you’ve bought your first
                                                home, moved
                                                into your very own apartment, moved out of the dorm room or you’re
                                                finally downsizing
                                                after all of your kids have left the nest.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="show-more">
                                        <span class="btn btn-main btn-block">Read more</span>
                                    </div>
                                </a>
                            </article>
                        </div>

                        <!-- === blog item === -->

                        <div class="col-sm-4">
                            <article>
                                <a href="article.html">
                                    <div class="image">
                                        <img src="/dist/assets/images/project-2.jpg" alt=""/>
                                    </div>
                                    <div class="entry entry-block">
                                        <div class="date">25 Mart 2017</div>
                                        <div class="title">
                                            <h2 class="h3">Making the Most Out of Your Kids Old Bedroom</h2>
                                        </div>
                                        <div class="description">
                                            <p>
                                                You’ve finally reached this point in your life- you’ve bought your first
                                                home, moved
                                                into your very own apartment, moved out of the dorm room or you’re
                                                finally downsizing
                                                after all of your kids have left the nest.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="show-more">
                                        <span class="btn btn-main btn-block">Read more</span>
                                    </div>
                                </a>
                            </article>
                        </div>

                        <!-- === blog item === -->

                        <div class="col-sm-4">
                            <article>
                                <a href="article.html">
                                    <div class="image">
                                        <img src="/dist/assets/images/project-3.jpg" alt=""/>
                                    </div>
                                    <div class="entry entry-block">
                                        <div class="date">28 Mart 2017</div>
                                        <div class="title">
                                            <h2 class="h3">Have a look at our new projects!</h2>
                                        </div>
                                        <div class="description">
                                            <p>
                                                You’ve finally reached this point in your life- you’ve bought your first
                                                home, moved
                                                into your very own apartment, moved out of the dorm room or you’re
                                                finally downsizing
                                                after all of your kids have left the nest.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="show-more">
                                        <span class="btn btn-main btn-block">Read more</span>
                                    </div>
                                </a>
                            </article>
                        </div>

                    </div> <!--/row-->
                    <!-- === button more === -->

                    <div class="wrapper-more">
                        <a href="ideas.html" class="btn btn-main">View all posts</a>
                    </div>

                </div> <!--/container-->
            </section>

            <!-- ========================  Banner ======================== -->
            <CBanner/>

            <!-- ========================  Blog ======================== -->
            <Blog/>

            <!-- ========================  Instagram ======================== -->
            <Instagram/>
            <!-- ================== Footer  ================== -->

            <Footer/>

        </div> <!--/wrapper-->

    </div>
</template>

