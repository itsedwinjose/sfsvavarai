<?php include("header.php"); ?>

<section class="page-header-gradient text-center">
  <div class="container">
    <h1 class="fw-bold text-white">School Activities</h1>
    <p class="lead">Our school encourages students to participate in a wide range of activities that support academic excellence, creativity and personal development.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">

<?php
$activities = [

[
"title" => "Curricular Activities",
"desc" => "Curricular activities include classroom learning, subject-based projects, seminars and academic competitions designed to strengthen students' understanding of subjects and encourage active participation in learning."
],

[
"title" => "Student Clubs",
"desc" => "Various student clubs such as Science Club, Literary Club, Eco Club and Arts Club provide opportunities for students to explore their interests, develop creativity and build teamwork skills."
],

[
"title" => "Extra-curricular Activities",
"desc" => "மாணவர்களுக்கு கூடுதல் பாடநெறி செயல்பாடுகளில், போன்றவை: கலாச்சார நடனம், ஆர்க் மற்றும் குரல் இசை, ஓவியம் மற்றும் கைவினை, சதுரங்கம், கராத்தே ஆகியவற்றில், குறிப்பிடப்பட்ட கட்டணத்தில் சிறப்பு பயிற்சி வழங்கப்படுகிறது."
],

[
"title" => "House System",
"desc" => "Students are divided into different houses to promote teamwork, leadership and healthy competition. Inter-house competitions are conducted throughout the academic year."
],

[
"title" => "NCC Activities",
"desc" => "The National Cadet Corps (NCC) program trains students in discipline, leadership, physical fitness and patriotism through camps, drills and social service activities."
],

[
"title" => "Scout & Guide Activities",
"desc" => "Scouting activities teach students survival skills, community service, teamwork and leadership while encouraging responsibility and self-reliance."
],

[
"title" => "PTA Meetings",
"desc" => "Regular Parent-Teacher Association meetings help maintain strong communication between parents and teachers regarding students’ academic performance and development."
],

[
"title" => "Alumni Meet",
"desc" => "Alumni meetings bring together former students to share their experiences and achievements, inspiring current students and strengthening the school community."
]

];

foreach($activities as $act){
echo '
<div class="col-md-4">
  <div class="card shadow-sm p-4 h-100 border-0">
    <h4 class="fw-bold text-primary">'.$act["title"].'</h4>
    <p>'.$act["desc"].'</p>
  </div>
</div>';
}
?>

    </div>
  </div>
</section>

<?php include("footer.php"); ?>