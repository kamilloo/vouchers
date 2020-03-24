<template>
    <div class="plan-selection" v-bind:class="{active: isActive}" >
        <slot ></slot>
    </div>
</template>

<script>
    export default {
        name: "CheckoutVoucherOption",
        data (){
          return {
              isActive: this.shouldActive(),
          }
        },
        props: [
            'selectedVoucherType',
            'optionVoucherType',
    ],
        watch: {
            selectedVoucherType(){
                this.isActive = this.shouldActive()
            }
        },
        methods: {
            shouldActive(){
                return this.selectedVoucherType == '' || this.selectedVoucherType == this.optionVoucherType
            }
        }
    }
</script>

<style scoped>
    .plan-selection {
        display: none;
    }
    .active {
        display: block;
    }
</style>
