<template>
    <div>
        <vue-headful
            title="Sprzedajemy bony upominkowe"
            description=""
        />
        <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12 mt-3">
            <main role="main">
                <div v-if="posts.length > 0">
<!--                        <h4 class="mb-4 border-bottom pb-2">-->
<!--                            <span class="border-bottom border-dark pb-2">Featured</span>-->
<!--                        </h4>-->

                    <featured-post-list :posts="posts.slice(0, featuredPostCount)"></featured-post-list>

<!--                        <h4 v-if="posts.slice(featuredPostCount).length > 0" class="my-4 border-bottom mt-5 pb-2">-->
<!--                            <span class="border-bottom border-dark pb-2">All Posts</span>-->
<!--                        </h4>-->

                    <post-list :posts="posts.slice(featuredPostCount)"></post-list>
                </div>

                <div v-else class="col-12">
                    <p class="lead text-muted text-center mt-5 pt-5">Brak artykułów</p>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
    import NProgress from 'nprogress'
    import vueHeadful from 'vue-headful'
    import Navbar from "./Navbar";
    import PostList from './PostList'
    import FeaturedPostList from "./FeaturedPostList";

    export default {
        name: 'home-screen',

        components: {
            FeaturedPostList,
            Navbar,
            PostList,
            vueHeadful
        },
        props: [
            'posts',
        ],
        data() {
            return {
                featuredPostCount: 4,
            }
        },

        mounted() {
        },

        methods: {
        }
    }
</script>
