<template>
    <div class="form-inline">
        <div class="form-group col-6">
            <label for="shopLinkInput" class="sr-only"></label>
            <input ref="shopLinkInput" type="text" class="form-control-plaintext" id="shopLinkInput" readonly v-model="shopLink">
        </div>
        <div class="form-group col-6 tooltip1">
            <button type="button" @mouseout="outFunc" @click="copyShopLink" class="btn btn-primary mb-2">
                <span class="tooltiptext" ref="myTooltip">Skopiuj do schowka</span>
                Kopiuj adres
            </button>

        </div>

    </div>
</template>

<script>
    export default {
        name: "ShopInput",
        props: {
            shopLink: String,
            // translate: String,
        },
        methods: {
            copyShopLink() {
                /* Get the text field */
                var copyText = this.$refs.shopLinkInput;

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /*For mobile devices*/

                /* Copy the text inside the text field */
                document.execCommand("copy");

                var tooltip = this.$refs.myTooltip;
                tooltip.innerHTML = "Skopiowane: <br>" + copyText.value;
            },
            outFunc() {
                var tooltip = this.$refs.myTooltip;
                tooltip.innerHTML = "Skopiuj do schowka";
            }
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
