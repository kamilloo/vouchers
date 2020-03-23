<template>
    <div class="form-group" >
        <slot name="label"></slot>
        <select class="form-control" :id="name" :name="name" v-model="product" :dusk="name">
            <option value="">Wybierz {{ label }}</option>
            <option v-for="product in products" :value="product.id">{{ product.title }}</option>
        </select>
        <slot name="error"></slot>
    </div>

</template>

<script>
    export default {
        name: "AddVoucherServiceSelect",
        data (){
          return {
              product: this.value
          }
        },
        props: {
            label: String,
            value: String,
            name: String,
            products: Array
            // translate: String,
        },
        watch: {
        },
        methods: {

        }
    }
</script>

<style scoped>


</style>
