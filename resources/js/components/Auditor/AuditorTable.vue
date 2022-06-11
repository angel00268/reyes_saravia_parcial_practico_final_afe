<template>
    <div class="table-responsive">
        <table class="table">
            <thead style="background-color: #9772FB " class="text-light">
                <tr>
                    <th v-for="(header, index) in headers" :key="index">{{ header }}</th>
                </tr>
            </thead>
            <tbody v-if="data">
                <tr v-if="data.length == 0">
                    <td :colspan="headers.length" class="text-center">
                        No se encontraron registros por mostrar.
                    </td>
                </tr>
                <tr v-for="(value, index) in data" :key="value.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ value.name }}</td>
                    <td>{{ value.email }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        headers: {
            type: Array,
            required: false,
            default: () => [],
        },
        data: {
            type: Array,
            required: true,
            default: () => [],
        },
    },
    mounted() {
        console.log(this.data);
    },
};
</script>

<style>
</style>
