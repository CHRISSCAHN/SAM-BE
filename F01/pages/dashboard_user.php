<?php
session_start();
include("../connect.php");
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['id'])) {
  header("Location: sign-in.php");
  exit();
}
$userid = $_SESSION['id'];

$query = "
  SELECT c.name, m.gold, m.silver, m.bronze 
  FROM country c
  JOIN medal m ON c.id = m.country_id
  ORDER BY m.gold DESC LIMIT 10
";


$result = mysqli_query($conn, $query);


$countries = [];
$gold_medals = [];
$silver_medals = [];
$bronze_medals = [];


while ($row = mysqli_fetch_assoc($result)) {
  $countries[] = $row['name'];
  $gold_medals[] = $row['gold'];
  $silver_medals[] = $row['silver'];
  $bronze_medals[] = $row['bronze'];
}


$countries_json = json_encode($countries);
$gold_medals_json = json_encode($gold_medals);
$silver_medals_json = json_encode($silver_medals);
$bronze_medals_json = json_encode($bronze_medals);

$query = "SELECT d.email, d.username, d.contact_number FROM users d JOIN user_details u
ON d.id = u.user_id WHERE u.id = '$userid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$userN = $row['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/chanlogs.png">
  <title>
    Olympics Blog by CHANCHAN
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Add Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/nimbus-ui/2.0.0/css/nimbus-icons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap"
    rel="stylesheet">

  <link href="../asset/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../asset/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="../asset/css/main.css" rel="stylesheet">


</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php include('dashboardnav_user.php'); ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include('nav.php'); ?>
    <main class="main">

      <!-- Slider Section -->
      <section id="slider" class="slider section dark-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="swiper init-swiper">

            <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "centeredSlides": true,
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "navigation": {
            "nextEl": ".swiper-button-next",
            "prevEl": ".swiper-button-prev"
          }
        }
      </script>

            <div class="swiper-wrapper">
              <?php
              $query = "SELECT * FROM game_reviews";
              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                $name = $row["game_name"];
                $content = $row["review_content"];
                $img = $row["img"];

                ?>
                <div class="swiper-slide" style="background-image: url('<?php echo $img ?>');">
                  <div class="content">
                    <h2><a href="medals.php"><?php echo $content ?></p>
                  </div>
                </div>
              <?php } ?>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <div class="swiper-pagination"></div>
          </div>

        </div>

      </section><!-- /Slider Section -->

      <!-- Trending Category Section -->
      <section id="trending-category" class="trending-category section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="container" data-aos="fade-up">
            <div class="row g-5">
              <div class="col-lg-4">
                <?php
                $query = "SELECT m.gold,c.name,c.flag FROM medal m JOIN country c WHERE m.country_id = 1 AND c.id=1";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $name = $row["name"];
                $img = $row["flag"];
                $gold = $row['gold'];

                ?>
                <div class="post-entry lg">
                  <a href="blog-details.html"><img src="<?php echo $img ?>" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date"><?php echo $gold . ' gold medals' ?></span> <span
                      class="mx-1">•</span> <span>Jan 5th
                      '22</span></div>
                  <h2><a href="medals.php"><?php echo $name ?></a></h2>
                  <p class="mb-4 d-block">The United States has consistently dominated the Olympics, earning the top
                    spot in total medals across numerous Games. With a legacy of excellence in athletics, swimming, and
                    gymnastics, the U.S. leads the all-time medal count with unmatched performances from world-class
                    athletes. This success reflects the nation's commitment to sports development and competitive
                    spirit.</p>

                  <div class="d-flex align-items-center author">
                    <div class="photo"><img src="../asset/img/person-1.jpg" alt="" class="img-fluid"></div>
                    <div class="name">
                      <h3 class="m-0 p-0"><?php echo $userN ?></h3>
                    </div>
                  </div>
                </div>

              </div>

              <div class="col-lg-8">
                <div class="row g-5">
                  <div class="col-lg-4 border-start custom-border">
                    <?php
                    $query = "
    SELECT 
        c.id, 
        c.name, 
        c.flag, 
        SUM(m.gold + m.silver + m.bronze) AS total_medals 
    FROM country c
    JOIN medal m ON c.id = m.country_id
    GROUP BY c.id, c.name, c.flag
    ORDER BY total_medals DESC LIMIT 6";

                    $result = mysqli_query($conn, $query);

                    $maxMedals = 0;
                    if ($row = mysqli_fetch_assoc($result)) {
                      $maxMedals = $row['total_medals'];
                      mysqli_data_seek($result, 0);
                    }

                    $rank = 1;
                    $columns = [[], []];

                    // Distribute the rows into two columns (1st to 3rd in the first column, 4th to 6th in the second column)
                    while ($row = mysqli_fetch_assoc($result)) {
                      $columns[($rank <= 3) ? 0 : 1][] = $row;
                      $rank++;
                    }
                    foreach ($columns[0] as $row) {
                      $name = $row["name"];
                      $medal = $row["total_medals"];
                      $id = $row["id"];
                      $flag = $row["flag"];
                      $progress = $maxMedals ? round(($medal / $maxMedals) * 100) : 0;

                      $suffix = 'th';
                      if ($rank == 1)
                        $suffix = 'st';
                      elseif ($rank == 2)
                        $suffix = 'nd';
                      elseif ($rank == 3)
                        $suffix = 'rd';

                      $position = $rank . $suffix . " place";
                      ?>
                      <div class="post-entry">
                        <a href="blog-details.html"><img src="<?php echo $flag ?>" alt="" class="img-fluid"></a>
                        <div class="post-meta"><span class="date">Sport</span> <span class="mx-1">•</span>
                          <span><?php echo $position ?></span>
                        </div>
                        <h2><a href="blog-details.html"><?php echo $name ?></a></h2>
                      </div>
                      <?php $rank++;
                    } ?>
                  </div>


                  <div class="col-lg-4 border-start custom-border">
                    <?php

                    foreach ($columns[1] as $row) {
                      $name = $row["name"];
                      $medal = $row["total_medals"];
                      $id = $row["id"];
                      $flag = $row["flag"];
                      $progress = $maxMedals ? round(($medal / $maxMedals) * 100) : 0;

                      // Correctly calculate the suffix based on the rank
                      $suffix = 'th';
                      if ($rank == 1)
                        $suffix = 'st';
                      elseif ($rank == 2)
                        $suffix = 'nd';
                      elseif ($rank == 3)
                        $suffix = 'rd';

                      $position = $rank . $suffix . " place";
                      ?>
                      <div class="post-entry">
                        <a href="blog-details.html"><img src="<?php echo $flag ?>" alt="" class="img-fluid"></a>
                        <div class="post-meta"><span class="date">Sport</span> <span class="mx-1">•</span>
                          <span><?php echo $position ?></span>
                        </div>
                        <h2><a href="blog-details.html"><?php echo $name ?></a></h2>
                      </div>
                      <?php $rank++;
                    } ?>
                  </div>

                  <!-- Trending Section -->
                  <div class="col-lg-4">

                    <div class="trending">
                      <h3>Next Games</h3>
                      <ul class="trending-post">
                        <?php
                        $query = "SELECT 
                            team1.name AS team1_name, 
                            team1.flag AS team1_flag, 
                            team2.name AS team2_name, 
                            team2.flag AS team2_flag, 
                            m.game_id ,
                            m.event_name, 
                            m.team1_odds, 
                            m.team2_odds, 
                            m.draw_odds, 
                            m.game_date, 
                            m.status
                          FROM games m
                          JOIN country team1 ON m.team1_id = team1.id
                          JOIN country team2 ON m.team2_id = team2.id LIMIT 5";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                          $id = $row["game_id"];
                          $gameName = $row["event_name"];
                          $fTeam = $row["team1_name"];
                          $lTeam = $row["team2_name"];
                          $fFlag = $row["team1_flag"];
                          $tFlag = $row["team2_flag"];
                          $fTeamOdds = $row["team1_odds"];
                          $lTeamOdds = $row["team2_odds"];
                          $drawOdds = $row["draw_odds"];
                          $status = $row["status"];
                          $gameDate = new DateTime($row['game_date']);
                          $now = new DateTime();
                          $interval = $now->diff($gameDate);
                          if ($now < $gameDate) {
                            if ($interval->days > 0) {
                              $timeRemaining = $interval->days . ' day' . ($interval->days > 1 ? 's' : '') . ' left';
                            } elseif ($interval->h > 0) {
                              $timeRemaining = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' left';
                            } elseif ($interval->i > 0) {
                              $timeRemaining = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' left';
                            } else {
                              $timeRemaining = 'Starting soon';
                            }
                          } else {
                            $timeRemaining = 'Game started';
                          }

                          $date = $gameDate->format('F j , Y');
                          ?>
                          <li>
                            <a href="blog-details.html">
                              <span class="number"><?php echo $id ?></span>
                              <h3><?php echo $gameName ?></h3>
                              <span class="author"><?php echo $timeRemaining ?></span>
                            </a>
                          </li>
                        <?php }
                        ?>
                      </ul>
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </section>

      <!-- Culture Category Section -->
      <section id="culture-category" class="culture-category section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <div class="section-title-container d-flex align-items-center justify-content-between">
            <h2>News</h2>
            <p><a href="categories.html">See All News</a></p>
          </div>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row">
            <div class="col-md-9">
              <?php
              $query = "SELECT m.gold,c.name,c.flag FROM medal m JOIN country c WHERE m.country_id = 2 AND c.id=2";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);
              $name2 = $row["name"];
              $img2 = $row["flag"];
              $gold2 = $row['gold'];

              ?>
              <div class="d-lg-flex post-entry">
                <a href="blog-details.html" class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                  <img src="<?php echo $img2 ?>" alt="" class="img-fluid">
                </a>
                <div>
                  <div class="post-meta"><span class="date"><?php echo $name2 ?></span> <span class="mx-1">•</span>
                    <span>Jan 5th
                      '24</span></div>
                  <h3><a href="blog-details.html">China: A Rising Force in the Olympics, Securing the Number 2 Spot Overall</a></h3>
                  <p>China has solidified its position as a global powerhouse in the Olympics, ranking second overall in
                    the all-time medal count. With a remarkable focus on sports like diving, table tennis,
                    weightlifting, and gymnastics, China has consistently showcased its elite athletes on the world
                    stage. </p>
                  <div class="d-flex align-items-center author">
                    <div class="photo"><img src="../asset/img/person-2.jpg" alt="" class="img-fluid"></div>
                    <div class="name">
                      <h3 class="m-0 p-0"><?php echo $userN ?></h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="post-list border-bottom">
                    <a href="blog-details.html"><img src="<?php echo $img ?>" alt=""
                        class="img-fluid"></a>
                    <div class="post-meta"><span class="date"><?php echo $name ?></span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html"><?php echo $gold . '  gold medals' ?></a>
                    </h2>
                    <span class="author mb-3 d-block"><?php echo $userN ?></span>
                    <p class="mb-4 d-block">The United States has consistently dominated the Olympics, earning the top
                    spot in total medals across numerous Games. With a legacy of excellence in athletics, swimming, and
                    gymnastics, the U.S. leads the all-time medal count with unmatched performances from world-class
                    athletes. This success reflects the nation's commitment to sports development and competitive
                    spirit.</p>
                  </div>

                  <div class="post-list">
                    <div class="post-meta"><span class="date"><?php echo $name2 ?></span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">Top 5 best Countries today</a></h2>
                    <span class="author mb-3 d-block"><?php echo $userN ?></span>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="post-list">
                    <a href="blog-details.html"><img src="../asset/img/post-landscape-2.jpg" alt=""
                        class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video
                        Calls?</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus
                      repudiandae, inventore pariatur numquam cumque possimus</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video
                    Calls?</a></h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">17 Pictures of Medium Length Hair in Layers That Will
                    Inspire Your New Haircut</a></h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a>
                </h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">Life Insurance And Pregnancy: A Working Mom’s Guide</a>
                </h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">The Best Homemade Masks for Face (keep the Pimples
                    Away)</a></h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a>
                </h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>
            </div>
          </div>

        </div>

      </section><!-- /Culture Category Section -->

      <!-- Business Category Section -->
      <section id="business-category" class="business-category section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <div class="section-title-container d-flex align-items-center justify-content-between">
            <h2>Business</h2>
            <p><a href="categories.html">See All Business</a></p>
          </div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row">
            <div class="col-md-9 order-md-2">

              <div class="d-lg-flex post-entry">
                <a href="blog-details.html" class="me-4 thumbnail d-inline-block mb-4 mb-lg-0">
                  <img src="../asset/img/post-landscape-3.jpg" alt="" class="img-fluid">
                </a>
                <div>
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th
                      '22</span></div>
                  <h3><a href="blog-details.html">What is the son of Football Coach John Gruden, Deuce Gruden doing
                      Now?</a></h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni
                    voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente,
                    laudantium dolorum itaque libero eos deleniti?</p>
                  <div class="d-flex align-items-center author">
                    <div class="photo"><img src="../asset/img/person-4.jpg" alt="" class="img-fluid"></div>
                    <div class="name">
                      <h3 class="m-0 p-0">Wade Warren</h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="post-list border-bottom">
                    <a href="blog-details.html"><img src="../asset/img/post-landscape-5.jpg" alt=""
                        class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">11 Work From Home Part-Time Jobs You Can Do Now</a>
                    </h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus
                      repudiandae, inventore pariatur numquam cumque possimus</p>
                  </div>

                  <div class="post-list">
                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">5 Great Startup Tips for Female Founders</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="post-list">
                    <a href="blog-details.html"><img src="../asset/img/post-landscape-7.jpg" alt=""
                        class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video
                        Calls?</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus
                      repudiandae, inventore pariatur numquam cumque possimus</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video
                    Calls?</a></h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">17 Pictures of Medium Length Hair in Layers That Will
                    Inspire Your New Haircut</a></h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a>
                </h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">Life Insurance And Pregnancy: A Working Mom’s Guide</a>
                </h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">The Best Homemade Masks for Face (keep the Pimples
                    Away)</a></h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a>
                </h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>
            </div>
          </div>

        </div>

      </section><!-- /Business Category Section -->

      <!-- Lifestyle Category Section -->
      <section id="lifestyle-category" class="lifestyle-category section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <div class="section-title-container d-flex align-items-center justify-content-between">
            <h2>Lifestyle</h2>
            <p><a href="categories.html">See All Lifestyle</a></p>
          </div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row g-5">
            <div class="col-lg-4">
              <div class="post-list lg">
                <a href="blog-details.html"><img src="../asset/img/post-landscape-8.jpg" alt="" class="img-fluid"></a>
                <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2><a href="blog-details.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus
                  repudiandae, inventore pariatur numquam cumque possimus exercitationem? Nihil tempore odit ab minus
                  eveniet praesentium, similique blanditiis molestiae ut saepe perspiciatis officia nemo, eos quae
                  cumque. Accusamus fugiat architecto rerum animi atque eveniet, quo, praesentium dignissimos</p>

                <div class="d-flex align-items-center author">
                  <div class="photo"><img src="../asset/img/person-7.jpg" alt="" class="img-fluid"></div>
                  <div class="name">
                    <h3 class="m-0 p-0">Esther Howard</h3>
                  </div>
                </div>
              </div>

              <div class="post-list border-bottom">
                <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">The Best Homemade Masks for Face (keep the Pimples
                    Away)</a></h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

              <div class="post-list">
                <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                    '22</span></div>
                <h2 class="mb-2"><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a>
                </h2>
                <span class="author mb-3 d-block">Jenny Wilson</span>
              </div>

            </div>

            <div class="col-lg-8">
              <div class="row g-5">
                <div class="col-lg-4 border-start custom-border">
                  <div class="post-list">
                    <a href="blog-details.html"><img src="../asset/img/post-landscape-6.jpg" alt=""
                        class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2><a href="blog-details.html">Let’s Get Back to Work, New York</a></h2>
                  </div>
                  <div class="post-list">
                    <a href="blog-details.html"><img src="../asset/img/post-landscape-5.jpg" alt=""
                        class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul
                        17th '22</span></div>
                    <h2><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a>
                    </h2>
                  </div>
                  <div class="post-list">
                    <a href="blog-details.html"><img src="../asset/img/post-landscape-4.jpg" alt=""
                        class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Mar
                        15th '22</span></div>
                    <h2><a href="blog-details.html">Why Craigslist Tampa Is One of The Most Interesting Places On the
                        Web?</a></h2>
                  </div>
                </div>
                <div class="col-lg-4 border-start custom-border">
                  <div class="post-list">
                    <a href="blog-details.html"><img src="../asset/img/post-landscape-3.jpg" alt=""
                        class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2><a href="blog-details.html">6 Easy Steps To Create Your Own Cute Merch For Instagram</a></h2>
                  </div>
                  <div class="post-list">
                    <a href="blog-details.html"><img src="../asset/img/post-landscape-2.jpg" alt=""
                        class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Mar 1st
                        '22</span></div>
                    <h2><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                  </div>
                  <div class="post-list">
                    <a href="blog-details.html"><img src="../asset/img/post-landscape-1.jpg" alt=""
                        class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2><a href="blog-details.html">5 Great Startup Tips for Female Founders</a></h2>
                  </div>
                </div>
                <div class="col-lg-4">

                  <div class="post-list border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video
                        Calls?</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-list border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">17 Pictures of Medium Length Hair in Layers That Will
                        Inspire Your New Haircut</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-list border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">9 Half-up/half-down Hairstyles for Long and Medium
                        Hair</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-list border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">Life Insurance And Pregnancy: A Working Mom’s Guide</a>
                    </h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-list border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">The Best Homemade Masks for Face (keep the Pimples
                        Away)</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                  <div class="post-list border-bottom">
                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th
                        '22</span></div>
                    <h2 class="mb-2"><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should
                        Know</a></h2>
                    <span class="author mb-3 d-block">Jenny Wilson</span>
                  </div>

                </div>
              </div>
            </div>

          </div>

        </div>

      </section>

    </main>

    <!-- Preloader -->
    <div id="preloader"></div>
    <?php
    include('footer.php');
    ?>
    <script src="../asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/vendor/php-email-form/validate.js"></script>
    <script src="../asset/vendor/aos/aos.js"></script>
    <script src="../asset/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>

    <!-- Main JS File -->
    <script src="../asset/js/main.js"></script>
    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>