<template>
    <div v-if="availablePosts.length > 0">
        <div v-for="post in availablePosts">
            <a :href="hrefLink(post)" class="text-decoration-none">
                <div class="card mb-4 shadow-sm">
                    <div class="row no-gutters">
                        <div :class="post.featured_image ? 'col-9' : ''">
                            <div class="card-body">
                                <h4 class="card-title mt-0">{{ post.title }}</h4>
                                <p class="card-text text-secondary">{{ post.summary }}</p>
                                <p class="card-text"><small class="text-muted">
                                    Opublikowane: {{ moment(post.published_at).format('DD.MM.YYYY') }}r.
                                </small></p>
                            </div>
                        </div>
                        <div v-if="post.featured_image" class="col-3">
                            <img :src="post.featured_image" class="card-img" :alt="post.featured_image_caption">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'post-list',

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

<style scoped>
    .card-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
    }
</style>
