<?php
include('includes/header.php'); // Esta linha deve ser a primeira
?>

<main>
    <section class="home" id="sobre">
        <div class="home-text">
            <h4 class="text-h4">Welcome to Food Peek</h4>
            <h1 class="text-h1">Different spices for different tastes</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe maiores, officiis soluta exercitationem architecto porro.</p>
            <a href="contato.php" class="home-btn">Place Order</a>
        </div>
        <div class="home-img">
            <img src="images/kingbun.png" alt="Imagem do Hambúrguer">
        </div>
    </section>

    <div class="slider">
        <div class="list">
            <div class="item">
                <img src="kingbun.png" alt="Burger Image 1">
            </div>
            <div class="item active">
                <img src="Main.png" alt="Main Image">
            </div>
            <div class="item">
                <img src="kingbun.png" alt="Burger Image 2">
            </div>
            <div class="item">
                <img src="Main.png" alt="Main Image Again">
            </div>
            <div class="item">
                <img src="kingbun.png" alt="Burger Image 3">
            </div>
        </div>
        <div class="circle">
            LUN DEV YOUTUBE - coding and design website - coding and design website
        </div>
        <div class="content">
            <div>Menu</div>
            <div>Restaurant</div>
            <button>See More</button>
        </div>
        <div class="arow">
            <button id="prev">&lt;</button>
            <button id="next">&gt;</button>
        </div>
    </div>
</main>

<script src="scriptcarrosell.js"></script>

<?php
include('includes/footer.php'); // Esta linha deve ser a última
?>