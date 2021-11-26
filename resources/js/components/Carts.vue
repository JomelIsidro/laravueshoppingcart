<template>
    <div>
        <h3>Cart</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
                <th>SubTotal</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="cart in carts" :key="cart.id">
                <td>{{ cart.name }}</td>
                <td>
                    <input v-model="cart.quantity" type="number" @input="updateCart(cart.id,cart.quantity)">    
                </td>
                <td>${{ cart.price }}</td>
                <td class="text-danger" style="cursor:pointer;" @click="removeItem(cart.id)">remove</td>
                <td>${{cart.price * cart.quantity}}</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <strong>TOTAL: ${{total}}</strong>
                </td>
            </tr>
            </tbody>
        </table>

        <div>
            <button class="btn btn-primary" @click="checkout(total)" data-toggle="modal" data-target="#checkoutCart">Proceed to Checkout</button>
        </div>

        <div class="modal fade" id="checkoutCart">
            <div v-if="showModal" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" ref="closeModal" class="close" data-dismiss="modal">
                            <span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3>Total Amount Payable : ${{total}}</h3>
                        <h4 class="mb-3">Payment Mode : <strong>COD</strong></h4>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Checkout">
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
                carts: [],
                total: 0,
                showModal : true,
                cart : {}
            }
        },
        created() {
            this.getCarts();
        },
        methods: {
            getCarts() {
                this.axios
                    .get('/api/carts')
                    .then(response => {
                        this.carts = response.data;
                        let totals = 0;
                        for (let i = 0; i < this.carts.length; i++) {
                            totals += this.carts[i].price * this.carts[i].quantity;
                        }
                        this.total = totals;
                    });
            },
            updateCart(id,qty) {
                if(qty == '') {
                    qty = 1;
                }
                const itemQty = {
                    'quantity' : qty
                };

                this.axios
                    .post('/api/updateCart/'+id, itemQty)
                    .then(response => (
                        this.getCarts()
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            checkout(total) {
                console.log(total);
            },
            removeItem(id) {
                this.axios
                    .post('/api/deleteCart/'+id)
                    .then(response => (
                        this.getCarts()
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>
