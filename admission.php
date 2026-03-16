<?php include("header.php"); ?>

<section class="py-5 bg-light text-center border-bottom">
  <div class="container">
    <h1 class="fw-bold text-primary mb-3">Admission Information</h1>
    <p class="lead mb-0">
      Parents seeking admission for their children are requested to read the following guidelines carefully.
    </p>
  </div>
</section>

<section class="py-5">
  <div class="container">

    <!-- Quick Highlights -->
    <div class="row g-4 mb-5">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-center p-4">
          <div class="card-body">
            <h5 class="fw-bold text-primary">School Timing</h5>
            <p class="mb-0">Monday to Friday<br>9:00 AM to 3:30 PM</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-center p-4">
          <div class="card-body">
            <h5 class="fw-bold text-primary">Minimum Attendance</h5>
            <p class="mb-0">Students must maintain <strong>95%</strong> attendance for academic progress.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-center p-4">
          <div class="card-body">
            <h5 class="fw-bold text-primary">Important Note</h5>
            <p class="mb-0">Fees once paid will not be refunded. Transfer Certificate will be issued only after full fee clearance.</p>
          </div>
        </div>
      </div>
    </div>

    <?php
    $sections = [

      [
        "title" => "School Schedule",
        "desc" => "
          <p>The school functions from Monday to Friday.</p>
          <ul class='mb-0'>
            <li>Class timing: 9:00 AM to 3:30 PM</li>
            <li>Students should arrive before the morning assembly</li>
            <li>Special activities and sports may be conducted in the afternoon</li>
          </ul>
        "
      ],

      [
        "title" => "Attendance",
        "desc" => "
          <ul class='mb-0'>
            <li>எல்லா மாணவர்களும் கல்வி ஆண்டில் முன்னேற்றத்திற்கு பரிசீலிக்கப்பட குறைந்தபட்சம் 95% வருகை தக்கவைப்படுத்த வேண்டும்.</li>
            <li>15 நாட்கள் மற்றும் அதற்கு மேலான அனுமதியற்ற விடுப்பு மாணவரின் பெயரை பதிவுப்பட்டியலில் இருந்து நீக்கத்திற்கு வழிவகுக்கும்.</li>
            <li>ஒவ்வொரு விடுப்பு, தாமதம், அனுமதி, கோரிக்கை மற்றும் விளக்கம் அலுவலகத்தில் கிடைக்கும் படிவங்களில் பதிவு செய்யப்பட வேண்டும்.</li>
            <li>படிவங்களின் ஜெராக்ஸ் நகல்கள் ஏற்கப்பட மாட்டாது.</li>
            <li>நோயினால் ஐந்து நாட்களுக்கு மேலான நீண்ட விடுப்புக்கு மருத்துவச் சான்றிதழ் கட்டாயம்.</li>
            <li>முன்கூட்டியே திட்டமிடப்பட்ட விடுப்புகளுக்காக, விடுப்பு படிவங்கள் முன்பே சமர்ப்பிக்கப்பட வேண்டும்.</li>
          </ul>
        "
      ],

      [
        "title" => "General Rules",
        "desc" => "
          <ul class='mb-0'>
            <li>மாணவர்கள் 08.15 மணிக்கு முன் பள்ளிக்கு வர வேண்டும்.</li>
            <li>பள்ளி டையரியை ஒவ்வொரு நாளும் எடுத்துக் கொண்டு வர வேண்டும்.</li>
            <li>ஒழுங்கற்ற வருகை, பள்ளி பணிகளில் அக்கறையின்மை, தவறான நடத்தை ஆகியவை பள்ளி பதிவிலிருந்து நீக்கத்திற்கு காரணமாகலாம்.</li>
            <li>பள்ளி சொத்துகளுக்கு அல்லது மற்ற மாணவர்களின் சொத்துகளுக்கு சேதம் ஏற்பட்டால் அதை ஈடு செய்ய வேண்டும்.</li>
            <li>தொற்றுநோயுள்ள மாணவர்கள் வகுப்பில் வர அனுமதிக்கப்பட மாட்டார்கள்.</li>
            <li>பள்ளிப் புத்தகங்களைத் தவிர வேறு புத்தகங்கள் பள்ளிக்கு கொண்டு வரக்கூடாது.</li>
            <li>அறிக்கைக் கார்டு மற்றும் டையரியில் பெற்றோர் கையொப்பம் இட வேண்டும்.</li>
            <li>மனிதாபிமான காரணங்களுக்கே விடுப்பு வழங்கப்படும்.</li>
            <li>மருத்துவச் சான்றிதழ் இல்லாமல் இறுதி பரீட்சையில் வராதவர்கள் தோல்வியடைந்ததாக கருதப்படுவர்.</li>
            <li>கல்வியாண்டு முடிவில் முடிவுகள் அறிவிப்பு பலகையிலும் பள்ளி இணையதளத்திலும் வெளியிடப்படும்.</li>
            <li>தனிப்பட்ட சுகாதாரத்திற்காக யூனிபார்மை சுத்தமாக அணிய வேண்டும்.</li>
            <li>மாணவர்கள் தங்க ஆபரணங்கள் அணியக்கூடாது.</li>
            <li>விளையாட்டு பொருட்கள் அல்லது தேவையற்ற பொருட்களை பள்ளிக்கு கொண்டு வரக்கூடாது.</li>
            <li>அடையாள அட்டை, பேட்ஜ், டைரி போன்றவை இழந்தால் அபராதம் வசூலிக்கப்படும்.</li>
            <li>பெற்றோர் மாணவர்களின் டைரியை தொடர்ந்து பரிசீலிக்க வேண்டும்.</li>
            <li>முகவரி அல்லது மொபைல் எண்ணில் மாற்றம் ஏற்பட்டால் பள்ளிக்கு தெரியப்படுத்த வேண்டும்.</li>
            <li>முதல்வரின் அனுமதியின்றி ஆசிரியர்களை சந்திக்க அனுமதி இல்லை.</li>
            <li>ஆசிரியர்களை அவர்களது மொபைல் எண்ணில் தொடர்புகொள்வது அனுமதிக்கப்படாது.</li>
            <li>பெற்றோர்/காப்பாளர்கள் அதிகாரிகளின் அனுமதியுடன் மட்டுமே பள்ளி வளாகத்தில் நுழையலாம்.</li>
            <li>அனைத்து விண்ணப்பங்களும், புகார்களும் முதல்வரிடம் சமர்ப்பிக்கப்பட வேண்டும்.</li>
            <li>டிஃபின் பெட்டி, குடை போன்றவற்றில் பெயர், வகுப்பு, பிரிவு குறிப்பிடப்பட வேண்டும்.</li>
            <li>பெற்றோர் சங்கமம் அழைக்கப்பட்டால் கலந்து கொள்ள வேண்டும்.</li>
            <li>முழு கட்டணம் செலுத்தப்படாவிட்டால் மாற்றுச் சான்றிதழ் வழங்கப்படாது.</li>
            <li>ஒருமுறை செலுத்திய கட்டணம் திருப்பி வழங்கப்பட மாட்டாது.</li>
            <li>ஆவணங்களுக்கு விண்ணப்பம் குறைந்தது 5 நாட்களுக்கு முன் அலுவலகத்தில் சமர்ப்பிக்க வேண்டும்.</li>
          </ul>
        "
      ],

      [
        "title" => "Examination and Promotion",
        "desc" => "
          <ul class='mb-0'>
            <li>ஒரு கல்வியாண்டில் மூன்று மிட்-டெர்ம், இரண்டு டெர்ம் மற்றும் ஆண்டு பரீட்சைகள் நடத்தப்படும்.</li>
            <li>இதற்கு மேலாக சோதனைத் தாள்கள் ஒழுங்கான இடைவெளிகளில் நடத்தப்படும்.</li>
            <li>அனைத்து பரீட்சைகளிலும் பங்கேற்பு கட்டாயம்.</li>
            <li>கிளாஸ் I முதல் V வரை மொத்த மதிப்பெண்களின் அடிப்படையில் முன்னேற்றம் வழங்கப்படும்.</li>
            <li>கிளாஸ் VI முதல் ஒவ்வொரு பாடத்திற்கும் தனித்தனி குறைந்தபட்ச மதிப்பெண் தேவைப்படும்.</li>
            <li>சில பாடங்களில் தொடர்ந்து தோல்வியடையும் மாணவர்கள் பள்ளியில் இருந்து விலகச் சொல்லப்படலாம்.</li>
            <li>கட்டண நிலுவை உள்ள மாணவர்களின் முன்னேற்றம் தடுக்கப்படலாம்.</li>
            <li>முழு கட்டணம் செலுத்தப்படாமல் இருந்தால் மாற்றுச் சான்றிதழ் வழங்கப்படாது.</li>
          </ul>
        "
      ],

      [
        "title" => "School Rules and Discipline",
        "desc" => "
          <ul class='mb-0'>
            <li>Students must maintain discipline inside and outside the classroom.</li>
            <li>Bullying, abusive language and damage to school property are strictly prohibited.</li>
            <li>Respect towards teachers, staff and fellow students is compulsory.</li>
          </ul>
        "
      ],

      [
        "title" => "Competitive Exams",
        "desc" => "
          <p class='mb-0'>The school encourages students to participate in Olympiads, scholarship examinations and other talent search programs to improve academic excellence and confidence.</p>
        "
      ],

      [
        "title" => "Homework & Snacks Schedule",
        "desc" => "
          <p class='mb-0'>Daily homework is assigned to reinforce classroom learning. Younger students are also provided short breaks for snacks and recreation during school hours.</p>
        "
      ],

      [
        "title" => "Online Examination",
        "desc" => "
          <p class='mb-0'>In special situations, examinations may be conducted online using approved digital platforms. Instructions will be shared in advance.</p>
        "
      ],

      [
        "title" => "Computer Government Certificate Exam",
        "desc" => "
          <p class='mb-0'>Students may appear for government-recognized computer certificate examinations to improve digital literacy and technical skills.</p>
        "
      ],

      [
        "title" => "School Uniform",
        "desc" => "
          <p class='mb-0'>Students must wear the prescribed school uniform on all working days. Separate uniforms may be prescribed for regular class days and sports days.</p>
        "
      ],

      [
        "title" => "School Calendar",
        "desc" => "
          <p class='mb-0'>The academic calendar includes holidays, exam schedules, school events, annual day, sports day and parent-teacher meetings.</p>
        "
      ]

    ];
    ?>

    <div class="accordion shadow-sm" id="admissionAccordion">
      <?php foreach($sections as $index => $sec){ ?>
        <div class="accordion-item border-0 mb-3 rounded overflow-hidden shadow-sm">
          <h2 class="accordion-header" id="heading<?php echo $index; ?>">
            <button class="accordion-button <?php echo $index != 0 ? 'collapsed' : ''; ?> fw-bold text-primary"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse<?php echo $index; ?>"
                    aria-expanded="<?php echo $index == 0 ? 'true' : 'false'; ?>"
                    aria-controls="collapse<?php echo $index; ?>">
              <?php echo $sec["title"]; ?>
            </button>
          </h2>
          <div id="collapse<?php echo $index; ?>"
               class="accordion-collapse collapse <?php echo $index == 0 ? 'show' : ''; ?>"
               aria-labelledby="heading<?php echo $index; ?>"
               data-bs-parent="#admissionAccordion">
            <div class="accordion-body" style="line-height: 1.8; font-size: 15px;">
              <?php echo $sec["desc"]; ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

  </div>
</section>

<?php include("footer.php"); ?>