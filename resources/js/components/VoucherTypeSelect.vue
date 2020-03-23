<template>
    <div class="form-group">
        <slot name="label"></slot>
        <select class="form-control" id="type" name="type" v-model="inputValue"  @change="$emit('change', $event.target.value)">

            <option value="">Wybierz typ</option>
            <option v-for="(type) in voucherTypes" :value="type.value" >{{ type.label }}</option>
        </select>
        <slot name="error"></slot>
    </div>


</template>

<script>
    export default {
        name: "VoucherTypeSelect",
        data (){
          return {
              inputValue: this.value,
              event: 'change'
          }
        },
        props: {
            voucherTypes: Array,
            value: String
            // translate: String,
        },
        watch: {
        },
        methods: {

        }
    }
</script>

<style scoped>
    .tooltip1 {
        position: relative;
        display: inline-block;
    }

    .tooltip1 .tooltiptext {
        visibility: hidden;
        width: 300px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -250px;
        opacity: 0;
        transition: opacity 0.3s;
        text-transform: none;
    }

    .tooltip1 .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    .tooltip1:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }

</style>
