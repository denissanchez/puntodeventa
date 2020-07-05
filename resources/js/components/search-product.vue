<template>
    <v-select placeholder="Buscar producto" :options="products" @search="fetch" label="name" :filterable="false">
        <template slot="no-options">
            Ingresar código o nombre del producto
        </template>
        <template slot="option" slot-scope="product">
            <div class="d-center">
                {{ product.name }}
            </div>
        </template>
        <template slot="selected-option" slot-scope="provider">
            <div class="selected d-center">
                {{ product.document }} - {{ product.name }}
            </div>
        </template>
    </v-select>
</template>

<script>
    import _ from 'lodash';

    export default {
        name: "search-product",
        data() {
            return {
                products: []
            }
        },
        methods: {
            fetch(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
                const value = (escape(search)).trim();
                if (value.length) {
                    axios.get(`/api/products?search=${escape(value)}`).then(({data}) => {
                        vm.products = data;
                        loading(false);
                    });
                }
            }, 1000)
        }
    }
</script>

<style scoped>

</style>
