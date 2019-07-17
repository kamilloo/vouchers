<template>
        <li>{{ todo.text }}</li>
</template>

<script>
    export default {
        props: ['todo'],
        data(){
            return {
                    innerTodo: this.todo
            }
        },
        created() {
        }
    }
</script>

<style scoped>

</style>