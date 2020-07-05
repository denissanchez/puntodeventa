<template>
    <v-select placeholder="Buscar proveedor" @input="handleChange" :options="owners" @search="fetch"
              label="name" :filterable="false">
        <template slot="no-options">
            Ingresar nombre o RUC del proveedor
        </template>
        <template slot="option" slot-scope="owner">
            <div class="d-center">
                {{ owners.document }} - {{ owners.name }}
            </div>
        </template>
        <template slot="selected-option" slot-scope="owner">
            <div class="selected d-center">
                {{ owner.document }} - {{ owner.name }}
            </div>
        </template>
    </v-select>
</template>

<script>
    import _ from 'lodash';

    export default {
        name: "search-owner-document",
        data() {
            return {
                owners: []
            }
        },
        methods: {
            fetch(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
                const value = escape(search);
                if (value.length > 3) {
                    axios.get(`/api/owners?search=${escape(search)}&digits=11`).then(response => {
                        vm.owners = response.data;
                        loading(false);
                    });
                } else {
                    loading(false);
                }
            }, 1000),
            handleChange(owner) {
                this.$emit('selected', owner);
            }
        }
    }
</script>

<style scoped>

</style>
