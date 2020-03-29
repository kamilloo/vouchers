<template>
    <div>
        <button type="button" v-bind:class="btnExtended" @click="toggleForm">{{ label }}</button>
        <form method="post" :action="action" v-bind:class="formDisplay" class="d-none">
            <slot></slot>
            <button type="submit" v-bind:class="btn">{{ label }}</button>
        </form>
    </div>

</template>

<script>
    export default {
        name: "FormLazyLoading",
        props: [
            'label',
            'btn',
            'action'
        ],
        data() {
            return {
                formDisplay: "d-none",
                btnExtended: this.btn
            }
        },
        methods: {
            toggleForm()
            {
                this.formDisplay = 'd-block';
                this.btnExtended = 'd-none'
            }
        }
    }
</script>

<style scoped>

</style>
