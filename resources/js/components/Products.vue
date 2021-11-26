<template>
    <div>
        <h3>Shopping Cart</h3><br/>

        <div class="row">
            <div class="col" v-for="product in products" :key="product.id">
                <div class="card">
                    <div class="card-header">
                        image
                    </div>
                    <div class="card-body">
                        <h1>{{ product.name }}</h1>
                        <p>${{ product.price }}</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" @click="buyProduct(product.id)">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
  

<script>
    
    export default {
        data() {
            return {
                products: []
            }
        },
        created() {
            this.getProducts();
        },
        methods: {
            buyProduct(id) {
                const post = {
                    'product_id' : id
                };

                this.axios
                    .post('/api/cart', post)
                    .then(response => (
                        alert(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            getProducts() {
                this.axios
                    .get('/api/products')
                    .then(response => {
                        this.products = response.data;
                    });
            }
        }
    }
</script>
