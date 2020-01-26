<template>
    <div class="widget">
        <h4 class="widget-title">Wish list</h4>
        <div class="summary-block">
            <div class="summary-content">
                <div class="summary-head"><h5 class="summary-title" :data-selected-voucher="selectedVoucher.id">{{ selectedVoucher.name }}</h5></div>
                <div class="summary-price">
                    <p class="summary-text">{{ selectedVoucher.price }} zł</p>
                </div>
            </div>
        </div>
        <div class="summary-block">
            <div class="summary-content">
                <div class="summary-head"> <h5 class="summary-title" :data-delivery-type="selectedDelivery.type">{{ selectedDelivery.title }}</h5></div>
                <div class="summary-price">
                    <p class="summary-text">{{ selectedDelivery.cost }} zł</p>
                </div>
            </div>
        </div>
        <div class="summary-block">
            <div class="summary-content">
                <div class="summary-head"> <h5 class="summary-title">Total</h5></div>
                <div class="summary-price">
                    <p class="summary-text">{{ total }} zł</p>
                    <input type="hidden" name="price" v-model="total">
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
         let selectedDelivery = this.deliveryTypes.find(this.getSelectedDelivery)
         let selectedVoucher = this.vouchers.find(this.getSelectedVoucher);

         if (typeof selectedVoucher !== 'undefined')
         {
             this.selectedVoucher.name = selectedVoucher.title;
             this.selectedVoucher.price = selectedVoucher.price;
         }else{
             this.resetSelectedVoucher();
         }

         if (typeof selectedDelivery !== 'undefined')
         {
             this.selectedDelivery.title = selectedDelivery.title;
             this.selectedDelivery.cost = selectedDelivery.cost;
             this.selectedDelivery.type = selectedDelivery.type;
         }else{
             this.resetSelectedDelivery();
         }
         this.computePrice();
     },
     methods: {
         computePrice() {
             this.total = parseFloat(this.selectedDelivery.cost) + parseFloat(this.selectedVoucher.price);
         },
         getSelectedVoucher(voucher){
             return voucher.id == this.selectedVoucher.id;
         },
         getSelectedDelivery(delivery){
             return delivery.type == this.selectedDelivery.type;
         },
         resetSelectedVoucher(){
             this.selectedVoucher.name = '-';
             this.selectedVoucher.price = 0;
         },
         resetSelectedDelivery(){
             this.selectedDelivery.type = '-';
             this.selectedDelivery.title = '-';
             this.selectedDelivery.cost = 0;
         }
     }


 }
</script>
