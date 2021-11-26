<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <span class="text-secondary">Simple Shopping Cart</span>
        </div>
  
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Products</router-link>
                    <router-link to="/cart" class="nav-item nav-link">Cart</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view></router-view>

        

    </div> <!-- end container -->
</template>
  
<script>
    export default {}
</script>