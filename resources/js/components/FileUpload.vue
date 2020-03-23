<template>
    <div id="image-uploader" class="text-center">
        <img v-show="!hasImage && fileSrc" :src="fileSrc" :width="filePreviewWidth">

        <image-uploader
                :preview="true"
                :maxWidth="600"
                :quality="0.7"
                :className="['fileinput', { 'fileinput--loaded': hasImage }]"
                capture="environment"
                :debug="1"
                :autoRotate="true"
                outputFormat="verbose"
                @input="setImage"
                :maxSize="200"
                :id="id"
        >
            <label :for="id" class="d-block" slot="upload-label">

                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <path class="path1" d="M9.5 19c0 3.59 2.91 6.5 6.5 6.5s6.5-2.91 6.5-6.5-2.91-6.5-6.5-6.5-6.5 2.91-6.5 6.5zM30 8h-7c-0.5-2-1-4-3-4h-8c-2 0-2.5 2-3 4h-7c-1.1 0-2 0.9-2 2v18c0 1.1 0.9 2 2 2h28c1.1 0 2-0.9 2-2v-18c0-1.1-0.9-2-2-2zM16 27.875c-4.902 0-8.875-3.973-8.875-8.875s3.973-8.875 8.875-8.875c4.902 0 8.875 3.973 8.875 8.875s-3.973 8.875-8.875 8.875zM30 14h-4v-2h4v2z"></path>
                    </svg>
                </figure>
                <span class="upload-caption">{{ hasImage ? 'Zmień obrazek' : 'Dodaj obrazek' }}</span>
            </label>

        </image-uploader>

    </div>
</template>

<script>
    import ImageUploader from "vue-image-upload-resize";
    Vue.use(ImageUploader);
    export default {
        name: "FileUpload",
        props: {
            fileName: {
                type: String,
                default: '',
            },
            fileSrc: {
                type: String,
                default: '',
            },
            filePreviewWidth: {
                type: String,
                default: '',
            },
            id: {
                type: String,
                default: 'fileInput',
            },
        },
        mounted (){

            [...document.getElementsByClassName("img-preview")].forEach(
                (element, index, array) => {
                    element.width = this.filePreviewWidth;

                }
            );

        },
        data() {
            return {
                hasImage: false,
                image: null
            }
        },
        methods: {
            setImage: function(output) {
                this.hasImage = true;
                this.image = output;
                let logo = document.getElementById(this.id);
                logo.name = this.fileName;
            }
        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>

    .fileinput {
        display: none;
    }
    h1,
    h2 {
        font-weight: normal;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        display: inline-block;
        margin: 0 10px;
    }
    a {
        color: #42b983;
    }
    .my-8 {
        margin-top: 4rem;
        margin-bottom: 4rem;
    }
</style>
