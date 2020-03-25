<template>
    <div>
                <tags-input element-id="tags" v-model="selectedTags" :existing-tags="existingTags" :typeahead="true" :placeholder="placeholder"/>
                <input v-for="(tag, index) in selectedTags" type="hidden" :key="index" :name="getKeyInputName(index)" v-model="tag.key">
                <input v-for="(tag, index) in selectedTags" type="hidden"  :key="index" :name="getValueInputName(index)" v-model="tag.value">
    </div>
</template>

<script>
    export default {
        name: "BranchInput",
        props: {
            selectedTags: Array,
            existingTags: Array,
            inputName: String,
            placeholder: String,
        },
        data (){
            return {
                name: this.inputName
            }
        },
        methods: {
            getKeyInputName(index){
                return this.name + "[" + index + "][key]";
            },
            getValueInputName(index){
                return this.name + "[" + index + "][value]";
            },
        }
    }
</script>

<style scoped>

</style>
