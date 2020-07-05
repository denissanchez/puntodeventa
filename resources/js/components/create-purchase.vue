<template>
    <div class="form-row">
        <div class="form-group col-12 col-lg-7">
            <label>Proveedor</label>
            <v-select placeholder="Buscar proveedor" @input="handleChange" :options="providers" @search="fetchProviders"
                      label="name" :filterable="false">
                <template slot="no-options">
                    Ingresar nombre o RUC del proveedor
                </template>
                <template slot="option" slot-scope="provider">
                    <div class="d-center">
                        {{ provider.document }} - {{ provider.name }}
                    </div>
                </template>
                <template slot="selected-option" slot-scope="provider">
                    <div class="selected d-center">
                        {{ provider.document }} - {{ provider.name }}
                    </div>
                </template>
            </v-select>
        </div>
        <div class="form-group col-12 col-lg-3">
            <label for="document">Código</label>
            <input type="text" name="document" id="document" placeholder="COD-000000"
                   class="form-control">
        </div>
        <div class="form-group col-12 col-lg-2">
            <label for="date">Fecha</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>
        <div class="form-group col-12 col-lg-12">
            <label>Producto</label>
            <search-product/>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    import SearchProduct from './search-product'

    export default {
        name: "create-purchase",
        components: {
            SearchProduct
        },
        data() {
            return {
                providers: [],
                products: []
            };
        },
        methods: {
            fetchProviders(search, loading) {
                loading(true);
                this.searchProvider(loading, search, this);
            },
            searchProvider: _.debounce((loading, search, vm) => {
                const value = escape(search);
                if (value.length > 3) {
                    axios.get(`/api/owners?search=${escape(search)}&digits=11`).then(response => {
                        vm.providers = response.data;
                        loading(false);
                    });
                } else {
                    loading(false);
                }
            }, 1000),
            handleChange(data) {
                console.log(data);
            }
        }
    }
</script>

<style scoped>

</style>
