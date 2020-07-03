<template>
    <div>
        <div class="form-row">
            <div class="form-group col-12 col-lg-7">
                <label>Proveedor</label>
                <v-select :options="providers" @search="fetchOptions" :filterable="false">
                    <template slot="no-options">
                        Ingresar nombre o RUC del proveedor
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
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';

    export default {
        name: "create-purchase",
        data() {
            return {
                providers: []
            };
        },
        beforeCreate() {
            axios.get('/api/providers');
        },
        methods: {
            fetchOptions(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
                axios.get(`/api/owners?search=${escape(search)}&digits=11`).then((response) => {
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                });
            }, 350)
        }
    }
</script>

<style scoped>

</style>
