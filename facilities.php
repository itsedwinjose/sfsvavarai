<?php include("header.php"); ?>

<section class="py-5 bg-light text-center">
  <div class="container">
    <h1 class="fw-bold text-primary">Facilities</h1>
    <p>Dummy facilities details. Replace later.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <?php
      $facilities = [
        "Laboratory",
        "Transport",
        "Library",
        "SMS Facilities",
        "Class Rooms",
        "Cricket Nets",
        "Kids Park",
        "Library"
      ];

      foreach($facilities as $fac){
        echo '
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Facility">
            <div class="card-body">
              <h5 class="fw-bold text-primary">'.$fac.'</h5>
              <p>Dummy text for '.$fac.'. Replace later.</p>
            </div>
          </div>
        </div>';
      }
      ?>
    </div>
  </div>
</section>

<?php include("footer.php"); ?>
