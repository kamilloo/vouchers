<template>
        <ul>
                <todo-item
                        v-for="ingredient in groceryList"
                        :todo="ingredient"
                        :key="ingredient.id"
                ></todo-item>
        </ul>
</template>

<script>
        export default {
        data (){
            return {
                todo: 'test',
                groceryList: [
                    { id: 0, text: 'fitst text'},
                    { id: 1, text: 'second text'},
                    { id: 2, text: 'third text'},
                ],
            }
        },
        created() {
        },
    }
</script>

<style scoped>

</style>