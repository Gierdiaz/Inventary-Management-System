<template>
<div class="container">
    <h1>Lista de Produtos</h1>
    <div v-for="product in products" :key="product.id" class="product-card">
    <h2>{{ product.name }}</h2>
    <p>{{ product.description }}</p>
    <p>Preço de custo: {{ product.cost_price }}</p>
    <p>Preço de venda: {{ product.sale_price }}</p>
    <p>Unidade: {{ product.unit }}</p>
    <p>Estoque mínimo: {{ product.stock_min }}</p>
    <p>Categoria: {{ product.category.name }}</p>
    <p>Fornecedor: {{ product.supplier.name }} ({{ product.supplier.contact }})</p>
    </div>
</div>
</template>

<script>
export default {
props: {
    products: {
    type: Array,
    required: true
    }
}
};
</script>

<style>
.container {
    max-width: 800px;
    margin: 0 auto;
}

.product-card {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
}

.product-card h2 {
    margin-top: 0;
}

.product-card p {
    margin-bottom: 5px;
}
</style>
