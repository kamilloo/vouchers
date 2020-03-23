<template>
    <div>
        <h1 class="my-4">{{ translate }}</h1>
        <div class="row">
            <div class="col-sm-12">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" :src="myTemplate.thumbnail" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">{{ myTemplate.title }}</a>
                        </h4>
                        <h5>{{ myTemplate.price }} zł</h5>
                        <p class="card-text">{{ myTemplate.description }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MyTemplate",
        props: {
            template: Object,
            translate: String,
            checked: Number,
            templates: Array
        },
        data (){
            return {
                myTemplate: this.template
                // activeChecked: this.template.id,
            }
        },
        watch:{
            checked(value){
                this.templates.forEach((template) => {
                   if (value == template.id)
                   {
                       this.myTemplate = template;
                   }
                });
            }
        }

    }
</script>

<style scoped>


</style>
