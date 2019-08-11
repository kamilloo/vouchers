<template>
    <div class="widget">
        <h4 class="widget-title">Wish list</h4>
        <div class="summary-block">
            <div class="summary-content">
                <div class="summary-head"><h5 class="summary-title">{{ selectedVoucher.name }}</h5></div>
                <div class="summary-price">
                    <p class="summary-text">${{ selectedVoucher.price }}</p>
                </div>
            </div>
        </div>
        <div class="summary-block">
            <div class="summary-content">
                <div class="summary-head"> <h5 class="summary-title">{{ selectedDelivery.type }}</h5></div>
                <div class="summary-price">
                    <p class="summary-text">${{ selectedDelivery.price }}</p>
                </div>
            </div>
        </div>
        <div class="summary-block">
            <div class="summary-content">
                <div class="summary-head"> <h5 class="summary-title">Total</h5></div>
                <div class="summary-price">
                    <p class="summary-text">$@{{ total }}</p>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
 export default {
     props: ['vouchers', 'selectedDelivery', 'selectedVoucher', 'deliveryTypes'],
     data (){
         return {
             total : '0'
         };
     },
     created () {

         this.resetSelectedDelivery();
         this.resetSelectedVoucher();

         this.computePrice();
     },
     updated() {
         if (this.selectedDelivery.type = this.deliveryTypes.POST)
         {
             this.selectedDelivery.price = 100;
         }else {
             this.selectedDelivery.price = 0
         }
         let selectedVoucher = this.vouchers.find(this.getSelectedVoucher);
         if (selectedVoucher.length)
         {
             this.selectedVoucher.name = selectedVoucher.title;
             this.selectedVoucher.price = selectedVoucher.price;
         }else{
             this.resetSelectedVoucher();
         }
         this.computePrice();
     },
     methods: {
         computePrice() {
             console.log('compute price');
             this.total = this.selectedDelivery.price + this.selectedVoucher.price;
         },
         getSelectedVoucher(voucher){
             return voucher.id == this.selectedVoucher.id;
         },
         resetSelectedVoucher(){
             this.selectedVoucher.name = '-';
             this.selectedVoucher.price = 0;
         },
         resetSelectedDelivery(){
             this.selectedDelivery.type = '-';
             this.selectedDelivery.price = 0;
         }
     }


 }
</script>