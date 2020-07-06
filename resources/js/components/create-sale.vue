<template>
    <div>
        <div class="form-row">
            <div class="form-group col-12 col-lg-2">
                <label for="client_document">RUC ó DNI</label>
                <input type="text" name="client_document" id="client_document"
                       v-model="client.document"
                       placeholder="RUC o DNI" class="form-control">
            </div>
            <div class="form-group col-12 col-lg-5">
                <label for="client">Razón social</label>
                <input type="text" name="client" id="client"
                       v-model="client.name"
                       placeholder="Razón social o nombre" class="form-control">
            </div>
            <div class="form-group col-12 col-lg">
                <label for="client_address">Dirección</label>
                <input type="text" name="client_address" id="client_address"
                       v-model="client.address"
                       placeholder="Dirección" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-lg-12">
                <label>Producto</label>
                <search-product @selected="addProduct" :validStock="true"/>
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
                    <th>P. Def</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="({ name, internal_code, measure_unit, quantity, price, price_defined, stock }, index) in products">
                    <td>{{ index + 1 }}</td>
                    <td>{{ `${internal_code} - ${name}` }}</td>
                    <td>
                        <InputNumber v-model="products[index].quantity" :min="0" :max="stock" mode="decimal"
                                     :minFractionDigits="2" :maxFractionDigits="2" :suffix="` ${measure_unit}`"/>
                    </td>
                    <td>
                        S/ {{ price | decimal }}
                    </td>
                    <td>
                        <InputNumber v-model="products[index].price_defined" :min="0" mode="decimal"
                                     :minFractionDigits="2" :maxFractionDigits="2" prefix="S/ "/>
                    </td>
                    <td>S/ {{ quantity * price_defined | decimal }}</td>
                    <td>
                        <button type="button" @click="removeProduct(index)" class="btn btn-danger btn-sm">x</button>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">Total</th>
                    <th colspan="2">S/ {{ total | decimal }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="row justify-content-end">
            <div v-if="saved" class="col-12 col-md-3 col-lg-2">
                <a href="/ventas/registrar" class="btn btn-info btn-block">
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
    import ShowErrors from './show-errors'
    import InputNumber from 'primevue/inputnumber';

    export default {
        name: "create-sale",
        components: {
            SearchProduct,
            ShowErrors,
            InputNumber
        },
        filters: {
            decimal: function (value) {
                return value.toFixed(2);
            }
        },
        data() {
            return {
                errors: null,
                saved: false,
                loading: false,
                products: [],
                client: {
                    name: 'CLIENTE',
                    address: '-',
                    document: '00000000'
                }
            }
        },
        methods: {
            addProduct(product) {
                this.products = [...this.products, {
                    ...product,
                    quantity: 0,
                    price: +product.price,
                    price_defined: +product.price
                }];
                console.log(this.products);
            },
            removeProduct(index) {
                this.products.splice(index, 1);
            },
            save() {
                this.errors = null;
                if (this.client.document.length === 11 || this.client.document.length === 8) {
                    axios.post('/api/sales', {
                        client: this.client,
                        products: this.products.map(({id, quantity, price_defined}) => {
                            return {
                                product_id: id,
                                quantity,
                                price_defined
                            }
                        }),
                    }).then(() => {
                        this.$toast.add({
                            severity: 'success',
                            summary: 'Se registró correctamente',
                            detail: 'Venta guardada correctamente',
                            life: 3000
                        });
                        this.saved = true;
                    }).catch(({response}) => {
                        const {data} = response;
                        this.errors = data.errors;
                    }).finally(() => {
                        this.loading = false;
                    })
                } else {
                    this.errors = {
                        ...this.errors,
                        client: ['Ingrese RUC o DNI válido']
                    }
                }
            }
        },
        computed: {
            total: function () {
                return this.products.reduce((total, {quantity, price_defined}) => quantity * price_defined + total, 0);
            }
        }
    }
</script>

<style scoped>

</style>
