<template>
    <div class="row row-cols-1 row-cols-md-2">
        <div v-for="post in availablePosts">
            <a  :href="hrefLink(post)" class="text-decoration-none">
                <div class="col mb-4">
                    <div class="card shadow-sm">
                        <img v-if="post.featured_image" :src="post.featured_image" class="card-img-top" :alt="post.featured_image_caption">
                        <div class="card-body">
                            <h5 class="card-title mt-0">{{ post.title }}</h5>
                            <p class="card-text text-secondary">{{ post.summary }}</p>
                        </div>
                        <div class="card-footer text-muted bg-transparent border-0 small d-flex justify-content-between">
                            <span>Opublikowane: {{ moment(post.published_at).format('DD.MM.YYYY') }}r.</span>
<!--                            <span>{{ post.read_time }}</span>-->
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'featured-post-list',

        props: {
            posts: {
                type: Array,
                required: true,
            },
        },

        data() {
            return {
                availablePosts: this.posts,
            }
        },
        methods:{
            hrefLink(post)
            {
                return '/blog/' + this.publicIdentifier(post) + '/' +  post.slug;
            }
        }
    }
</script>
