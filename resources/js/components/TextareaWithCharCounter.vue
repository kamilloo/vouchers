<template>
    <div>
        <small class="form-text text-muted">
            <span >{{ maxLengthTextHelper }}&nbsp;{{ maxLength }}&nbsp;{{ leftTextHelper }}&nbsp;{{ left }}</span>
        </small>
        <textarea maxlength="255" type="text" :id="name" class="form-control" :placeholder="placeholder" :name="name" rows="6" @keyup="countChars"  v-model="message" ></textarea>
    </div>

</template>

<script>
    export default {
        name: "TextareaWithCharCounter",
        props: [
            'maxLengthTextHelper',
            'leftTextHelper',
            'value',
            'placeholder',
            'name'
        ],
        data() {
            return {
                counter: this.value.length,
                maxLength: 200,
                left: 200 - this.value.length,
                message: this.value
            }
        },
        methods: {
            countChars(){
                this.message = this.message.substring(0,200)
                this.counter = this.message.length
                this.left = this.maxLength - this.counter

            }
        }
    }
</script>

<style scoped>

</style>
