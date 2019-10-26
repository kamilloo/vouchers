<template>
    <div :class="cardClass">

        <div class="position-absolute">
            <div class="custom-control custom-checkbox">

                <input class="custom-control-input" type="radio" name="template_id" :id="id" :value="template.id">
                <label class="custom-control-label" :for="id">
                    << {{ template.title }} >>
                </label>
            </div>

        </div>

        <a href="#"><img class="card-img-top" :src="template.thumbnail" alt=""></a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="#">{{ template.title }}</a>
            </h4>
            <h5>${{ template.price }}</h5>
            <p class="card-text">{{ template.description }}</p>
        </div>
        <div class="card-footer">
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
        </div>
    </div>

</template>

<script>
    export default {
        name: "TemplateCheckbox",
        props: {
            template: Object,
            checked: Number
        },
        data (){
            return {
                id: null,
                cardClass: {
                    'card h-100': true,
                    'shadow border border-primary rounded': this.checked
                }
            }
        },
        created() {
           this.id = "template-radio-" + this.template.id
        }
    }
</script>

<style scoped>

</style>
