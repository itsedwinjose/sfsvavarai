<?php include("header.php"); ?>

<section class="py-5 bg-light text-center">
  <div class="container">
    <h1 class="fw-bold text-primary">Activities</h1>
    <p>Dummy activity details. Replace later.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <?php
      $activities = [
        "Curricular Activities",
        "Clubs",
        "Extra-curricular",
        "Houses",
        "NCC Activity",
        "Scout Activities",
        "PTA Meeting",
        "Alumni Meet in School"
      ];

      foreach($activities as $act){
        echo '
        <div class="col-md-4">
          <div class="card shadow-sm p-4 h-100">
            <h4 class="fw-bold text-primary">'.$act.'</h4>
            <p>Dummy description for '.$act.'. Replace later.</p>
          </div>
        </div>';
      }
      ?>
    </div>
  </div>
</section>

<?php include("footer.php"); ?>
