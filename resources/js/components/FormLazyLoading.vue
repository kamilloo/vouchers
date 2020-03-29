<template>
    <div>
        <div v-bind:class="{'d-none': buttonHide}" @click="toggleForm">
            <slot name="button"></slot>
        </div>
        <form method="post" :action="action" v-bind:class="formDisplay">
            <slot name="form"></slot>
        </form>
    </div>

</template>


<script>
    export default {
        name: "FormLazyLoading",
        props: [
            'action'
        ],
        data() {
            return {
                formDisplay: "d-none",
                buttonHide: false,
            }
        },
        methods: {
            toggleForm()
            {
                this.formDisplay = 'd-block';
                this.buttonHide = true
            }
        }
    }
</script>

<style scoped>

</style>
