<template>
    <div>
        <div class="form-row">
            <div class="form-group col-12 col-lg">
                <label>Proveedor</label>
                <search-owner-document @selected="setProvider"/>
            </div>
            <div class="form-group col-12 col-lg-auto">
                <label>Código</label>
                <input type="text" placeholder="COD-000000" v-model="document"
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
        <show-errors :errors="errors"/>
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
                <tr v-for="({ name, internal_code, measure_unit, quantity, price }, index) in products">
                    <td>{{ index + 1 }}</td>
                    <td>{{ `${internal_code} - ${name}` }}</td>
                    <td>
                        <InputNumber v-model="products[index].quantity" :min="0" mode="decimal"
                                     :minFractionDigits="2" :maxFractionDigits="2" :suffix="` ${measure_unit}`"/>
                    </td>
                    <td>
                        <InputNumber v-model="products[index].price" :min="0" mode="decimal"
                                     :minFractionDigits="2" :maxFractionDigits="2" prefix="S/ "/>
                    </td>
                    <td>S/ {{ quantity * price | decimal }}</td>
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
            <div v-if="saved" class="col-12 col-md-3 col-lg-2">
                <a href="/compras/registrar" class="btn btn-info btn-block">
                    Nuevo registro
                </a>
            </div>
            <div v-else class="col-12 col-md-3 col-lg-2">
                <button type="submit" class="btn btn-primary btn-block" @click="save" :disabled="loading">
                    <span v-if="loading" class="spinner-border spinner-border-sm" role="status"
                          aria-hidden="true"></span>
                    Guardar
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import SearchProduct from './search-product'
    import SearchOwnerDocument from './search-owner-document'
    import ShowErrors from './show-errors'
    import InputNumber from 'primevue/inputnumber'
    import DatePicker from 'vue2-datepicker'
    import 'vue2-datepicker/index.css'
    import 'vue2-datepicker/locale/es'

    export default {
        name: "create-purchase",
        components: {
            ShowErrors,
            SearchProduct,
            SearchOwnerDocument,
            InputNumber,
            DatePicker,
        },
        filters: {
            decimal: function (value) {
                return value.toFixed(2);
            }
        },
        data() {
            return {
                provider: {},
                products: [],
                document: "",
                date: new Date(),
                loading: false,
                errors: null,
                saved: false
            };
        },
        methods: {
            setProvider(data) {
                this.provider = {...data}
            },
            addProduct(product) {
                this.products = [...this.products, {...product, quantity: 0, price: 0}];
            },
            removeProduct(index) {
                this.products.splice(index, 1);
            },
            save() {
                this.errors = null;
                axios.post('/api/purchases', {
                    owner_id: this.provider.id,
                    date: this.date,
                    document: this.document,
                    products: this.products.map(({id, quantity, price}) => {
                        return {
                            product_id: id,
                            quantity,
                            price
                        }
                    }),
                }).then(() => {
                    this.$toast.add({severity:'success', summary: 'Se registró correctamente', detail:'Compra guardada correctamente', life: 3000});
                    this.saved = true;
                }).catch(({ response }) => {
                    const { data } = response;
                    this.errors = data.errors;
                }).finally(() => {
                    this.loading = false;
                })
            }
        },
        computed: {
            total: function () {
                return this.products.reduce((total, {quantity, price}) => quantity * price + total, 0);
            }
        }
    }
</script>

<style scoped>

</style>
