<template>
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-3">
            <tbody v-if="data">
                <tr>
                    <th colspan="2" class="text-center">Detalles del producto</th>
                </tr>
                <tr>
                    <th>Nombre del producto</th>
                    <td>{{ data.product_name }}</td>
                </tr>
                <tr>
                    <th>Precio unitario</th>
                    <td>${{ data.unit_price }}</td>
                </tr>
                <tr>
                    <th>Existencia en inventario</th>
                    <td>{{ data.stock }}</td>
                </tr>
                <tr>
                    <th>Garantía</th>
                    <td>{{ data.warranty }}</td>
                </tr>
                <tr>
                    <th>Descripción del producto</th>
                    <td>{{ data.product_description }}</td>
                </tr>
            </tbody>
        </table>
        <a href="#" class="btn btn-primary" @click="showClose()"><i class="fa fa-arrow-left"></i>
            Regresar
        </a>
    </div>
</template>

<script>
export default {
    props: {
        data: {
            type: Object,
            required: true,
            default: () => [],
        },
    },
    mounted() {
        console.log(this.data);
    },
    methods: {
        async showClose() {
            this.$emit("showClose");
        },
    },
};
</script>
