<template>
    <div v-if="errors != null" class="alert alert-danger">
        <ul class="m-0">
            <li v-for="(v, k) in errors" :key="k">
                <span v-for="error in v" :key="error">
                    {{ error }}
                </span>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            errors: Object
        },
        name: "show-errors"
    }
</script>

<style scoped>

</style>
