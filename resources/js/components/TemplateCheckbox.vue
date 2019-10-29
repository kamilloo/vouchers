<template>
    <div :class="cardClass" >
        <input type="radio" name="template_id" :id="id" :value="template.id" v-model="radioButtonValue" @change="changeTemplate">
        <label :for="id">

            <img class="card-img-top" :src="template.thumbnail" alt="">
            <div class="card-body">
                <h4 class="card-title">
                    {{ template.title }}
                </h4>
                <h5>${{ template.price }}</h5>
                <p class="card-text">{{ template.description }}</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
        </label>
    </div>
</template>

<script>
    export default {
        name: "TemplateCheckbox",
        props: {
            template: Object,
            checked: Number,
        },
        data (){
            return {
                id: null,
                activeChecked: this.template.id,
                cardClass: {
                    'card h-100': true,
                    'shadow border border-primary rounded': this.activeChecked == this.template.id
                },
            }
        },
        computed: {
            radioButtonValue: {
                get: function() {
                    return this.template.id
                },
                set: function() {
                    this.$emit("change", this.template.id)
                    this.activeChecked = this.template.id
                }
            }
        },
        created() {
           this.id = "template-radio-" + this.template.id
        },
        methods: {
            setCardClass: function () {
                this.cardClass = {
                    'card h-100': true,
                    'shadow border border-primary rounded': this.checked == this.template.id
                };
            }, changeTemplate(value){
                this.setCardClass();
            }
        },
        watch:{
            checked(oldValue, newValue){
                this.setCardClass();
            }
        }

    }
</script>

<style scoped>
    [type=radio] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    [type=radio] + label {
        cursor: pointer;
    }

</style>
