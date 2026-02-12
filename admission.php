<?php include("header.php"); ?>

<section class="py-5 bg-light text-center">
  <div class="container">
    <h1 class="fw-bold text-primary">Admission</h1>
    <p>Dummy admission details. Replace later.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">

      <?php
      $sections = [
        "School Schedule",
        "Examination",
        "General Rules",
        "School Fees",
        "School Rules and Discipline",
        "Competitive Exam",
        "Homework Snacks Schedule",
        "Online Exam",
        "Computer Government Certificate Exam",
        "School Uniform",
        "Calendar"
      ];

      foreach($sections as $sec){
        echo '
        <div class="col-md-6">
          <div class="card shadow-sm p-4 h-100">
            <h4 class="fw-bold text-primary">'.$sec.'</h4>
            <p>Dummy content for '.$sec.'. Replace later.</p>
          </div>
        </div>';
      }
      ?>

    </div>
  </div>
</section>

<?php include("footer.php"); ?>
