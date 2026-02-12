<?php include("header.php"); ?>

<section class="py-5 bg-light text-center">
  <div class="container">
    <h1 class="fw-bold text-primary">Gallery</h1>
    <p>Dummy gallery images (replace later).</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-3">
      <?php
      for($i=1; $i<=12; $i++){
        echo '
        <div class="col-md-3 col-sm-6">
          <div class="card shadow-sm">
            <img src="https://picsum.photos/400/300?random='.$i.'" class="img-fluid rounded" alt="Gallery Image">
          </div>
        </div>';
      }
      ?>
    </div>
  </div>
</section>

<?php include("footer.php"); ?>
