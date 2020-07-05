<template>
    <div>
        <div class="form-row">
            <div class="form-group col-12 col-lg">
                <label>Proveedor</label>
                <search-owner-document @selected="setProvider"/>
            </div>
            <div class="form-group col-12 col-lg-auto">
                <label for="document">Código</label>
                <input type="text" name="document" id="document" placeholder="COD-000000"
                       class="form-control text-uppercase">
            </div>
            <div class="form-group col-12 col-lg-auto">
                <label>Fecha</label>
                <br>
                <date-picker input-class="form-control" v-model="date" format="DD/MM/YYYY"/>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-lg-12">
                <label>Producto</label>
                <search-product @selected="addProduct"/>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>P. Unit</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="({ name, internal_code, measure_unit, quantity, unit_price }, index) in products">
                    <td>{{ index + 1 }}</td>
                    <td>{{ `${internal_code} - ${name}` }}</td>
                    <td>
                        <InputNumber v-model="products[index].quantity" :min="0.01" mode="decimal"
                                     :minFractionDigits="2" :maxFractionDigits="2" :suffix="` ${measure_unit}`"/>
                    </td>
                    <td>
                        <InputNumber v-model="products[index].unit_price" :min="0.01" mode="decimal"
                                     :minFractionDigits="2" :maxFractionDigits="2" prefix="S/ "/>
                    </td>
                    <td>S/ {{ quantity * unit_price | decimal }}</td>
                    <td>
                        <button type="button" @click="removeProduct(index)" class="btn btn-danger btn-sm">x</button>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <th colspan="2">S/ {{ total | decimal }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="row justify-content-end">
            <div class="col-12 col-md-3 col-lg-2">
                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
            </div>
        </div>
    </div>
</template>

<script>
    import SearchProduct from './search-product'
    import SearchOwnerDocument from './search-owner-document'
    import InputNumber from 'primevue/inputnumber';

    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import 'vue2-datepicker/locale/es';

    export default {
        name: "create-purchase",
        components: {
            SearchProduct,
            SearchOwnerDocument,
            InputNumber,
            DatePicker
        },
        filters: {
            decimal: function (value) {
                return value.toFixed(2);
            }
        },
        data() {
            return {
                provider: null,
                products: [],
                date: new Date()
            };
        },
        methods: {
            setProvider(data) {
                this.provider = {...data}
            },
            addProduct(product) {
                this.products = [...this.products, {...product, quantity: 0, unit_price: 0}];
            },
            removeProduct(index) {
                this.products.splice(index, 1);
            }
        },
        computed: {
            total: function () {
                return this.products.reduce((total, {quantity, unit_price}) => quantity * unit_price + total, 0);
            }
        }
    }
</script>

<style scoped>

</style>
