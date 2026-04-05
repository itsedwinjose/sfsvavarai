<?php include("header.php"); ?>

<section class="page-header-gradient text-center">
  <div class="container">
    <h1 class="fw-bold text-white">News & Events</h1>
    <p>Latest school events (dummy list for now).</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <?php
      $events = [
        "School Day",
        "Sports Day",
        "Blessing Day",
        "Yoga Day",
        "Independence Day",
        "Teachers Day",
        "Christmas Celebration"
      ];

      $eventImages = [
        "School Day" => "https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80",
        "Sports Day" => "assets/images/sports-day.jpeg",
        "Blessing Day" => "https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80",
        "Yoga Day" => "assets/images/yoga-day.jpeg",
        "Independence Day" => "assets/images/independence-day.jpeg",
        "Teachers Day" => "assets/images/teachers-day.jpeg",
        "Christmas Celebration" => "assets/images/christmas-day.jpeg"
      ];

      foreach($events as $event){
        $image = $eventImages[$event] ?? "https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80";
        echo '
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <img src="'.$image.'" class="card-img-top" alt="Event">
            <div class="card-body">
              <h5 class="fw-bold text-primary">'.$event.'</h5>
              <p>Dummy event details for '.$event.'. Replace later.</p>
              <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
            </div>
          </div>
        </div>';
      }
      ?>
    </div>
  </div>
</section>

<?php include("footer.php"); ?>
