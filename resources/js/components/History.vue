<template>
    <div>
        <h3>History</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="cart in carts" :key="cart.id">
                <td>{{ cart.name }} x {{cart.quantity}}</td>
                <td>${{ cart.price }}</td>
                <td>{{ cart.created_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
  

<script>
    
    export default {
        data() {
            return {
                carts: []
            }
        },
        created() {
            this.getCarts();
        },
        methods: {
            getCarts() {
                this.axios
                    .get('/api/cartsHistory')
                    .then(response => {
                        console.log(response.data);
                        this.carts = response.data;
                    });
            }
        }
    }
</script>
