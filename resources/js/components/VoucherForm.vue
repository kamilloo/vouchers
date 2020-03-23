<template>
    <form method="post" :action="action" enctype="multipart/form-data" role="form">
        <slot name="method"/>
        <slot name="csrf"/>
        <voucher-type-select :voucherTypes="voucherTypes" @change="changeVoucherType" v-model="voucherType">
                <slot name="type-label" slot="label"/>
                <slot name="type-error" slot="error"/>
        </voucher-type-select>
        <div v-if="activePrice">
            <slot name="price"/>
        </div>
        <div v-if="activeService">
            <slot name="service"/>
        </div>
        <div v-if="activeServicePackage">
            <slot name="package"/>
        </div>
        <slot name="description"/>

        <slot name="file"/>
        <slot name="submit"/>
    </form>
</template>

<script>
    export default {
        name: "VoucherForm",
        data (){
          return {
              voucherType: this.flashVoucherType,
              activePrice: false,
              activeService: false,
              activeServicePackage: false,
          }
        },
        props: {
            action: String,
            translate: String,
            voucherTypes: Array,
            voucherServiceType: String,
            voucherServicePackageType: String,
            voucherQuoteType: String,
            flashVoucherType: String
        },
        created() {
            this.activePrice = this.voucherType === this.voucherQuoteType;
            this.activeService = this.voucherType === this.voucherServiceType;
            this.activeServicePackage = this.voucherType === this.voucherServicePackageType
        },
        watch: {
        },
        methods: {
            changeVoucherType(voucherType){
                this.voucherType = voucherType;
                this.activePrice = this.voucherType === this.voucherQuoteType;
                this.activeService = this.voucherType === this.voucherServiceType;
                this.activeServicePackage = this.voucherType === this.voucherServicePackageType;
            }
        }
    }
</script>

<style scoped>

</style>
