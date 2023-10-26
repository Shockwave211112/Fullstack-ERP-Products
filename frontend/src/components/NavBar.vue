<template>
    <aside class="navBar">
        <div class="header">
            <div class="logo">
                <img src="../assets/logo.svg" alt="">
            </div>
            <div class="company_name">
                <p>Enterprise</p>
                <p>Resource</p>
                <p>Planning</p>
            </div>
        </div>
        <div class="items">
            <a href="#">Продукты</a>
        </div>
        
    </aside>
</template>

<script>

</script>

<style scoped>
    .navBar {
        background-color: #374050;
        width: 180px;
        font-size: 11px;
        font-weight: 400;
    }
    .logo {
        width: 79px;
        height: 59px;
        flex-shrink: 0;
        border-radius: 0px 0px 20px 0px;
        background: #FFF;
        padding: 18px 13px;
    }
    .company_name {
        text-align: left;
        margin: 7px 12px;
        color: #FFF;
        line-height: 11px;
    }
    .header {
        display: flex;
    }
    .items a {
        text-decoration: none;
        color: rgba(255, 255, 255, 0.70);
    }
    .items {
        display: flex;
        margin: 13px 34px;
    }
</style>