<div class="container my-4 text-center">
    <h1 class="text-uppercase fw-bold text-primary">CV Gallery</h1>
    <div class="row">
    
    <?php
    include 'Views/Components/cardCV.php';
    for ($i = 0; $i < 10; $i++) {
        renderCvCard('Le Thanh Binh', 'Web Developer', 1);
    }
    ?>
    </div>
</div>