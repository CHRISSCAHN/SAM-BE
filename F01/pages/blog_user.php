<?php
session_start();
include("../connect.php");
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['id'])) {
  header("Location: sign-in.php");
  exit();
}
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

  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/nimbus-ui/2.0.0/css/nimbus-icons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/nucleo/css/nucleo.css" rel="stylesheet">
  <style>
    .match-row {
      display: flex;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #ddd;
    }

    .team-name {
      flex: 1;
      display: flex;
      align-items: center;
    }

    .team-name img {
      width: 20px;
      height: 20px;
      margin-right: 10px;
    }

    .bet-options {
      flex: 3;
      display: flex;
      justify-content: space-around;
    }

    .bet-options button {
      width: 100px;
      text-align: center;
    }

    .extra-info {
      flex: 1;
      text-align: end;
      color: #888;
    }

    .section-header {
      background-color: #6c757d;
      color: white;
      padding: 10px;
      font-weight: bold;
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php include('dashboardnav_user.php'); ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="../index.html">User login</a>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Admin</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg"
                          class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background"
                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                    opacity="0.593633743"></path>
                                  <path class="color-background"
                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                  </path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container ">
      <div class="mt-2">
        <div class="dropdown mb-3">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
            data-bs-toggle="dropdown" aria-expanded="false">
            National Championship (6)
          </button>
          <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
            <li>
              <div class="container-fluid p-3">
                <div class="match-row">
                  <div class="team-name">
                    <img src="https://via.placeholder.com/20" alt="icon"> Real Madrid vs Chelsea
                  </div>
                  <div class="bet-options">
                    <button class="btn btn-primary" onclick="placeBet('Real Madrid')">Real Madrid <br> 1.23</button>
                    <button class="btn btn-warning" onclick="placeBet('Draw')">Draw <br> 13.00</button>
                    <button class="btn btn-danger" onclick="placeBet('Chelsea')">Chelsea <br> 34.25</button>
                  </div>
                  <div class="extra-info">+58</div>
                </div>
                <div class="match-row">
                  <div class="team-name">
                    <img src="https://via.placeholder.com/20" alt="icon"> Arsenal vs Everton
                  </div>
                  <div class="bet-options">
                    <button class="btn btn-primary" onclick="placeBet('Arsenal')">Arsenal <br> 2.83</button>
                    <button class="btn btn-warning" onclick="placeBet('Draw')">Draw <br> 7.00</button>
                    <button class="btn btn-danger" onclick="placeBet('Everton')">Everton <br> 12.15</button>
                  </div>
                  <div class="extra-info">+46</div>
                </div>
                <div class="match-row">
                  <div class="team-name">
                    <img src="https://via.placeholder.com/20" alt="icon"> West Ham United vs Bournemouth
                  </div>
                  <div class="bet-options">
                    <button class="btn btn-primary" onclick="placeBet('West Ham United')">West Ham <br> 4.17</button>
                    <button class="btn btn-warning" onclick="placeBet('Draw')">Draw <br> 17.00</button>
                    <button class="btn btn-danger" onclick="placeBet('Bournemouth')">Bournemouth <br> 18.52</button>
                  </div>
                  <div class="extra-info">+51</div>
                </div>
                <div class="match-row">
                  <div class="team-name">
                    <img src="https://via.placeholder.com/20" alt="icon"> Leicester City vs Atletico
                  </div>
                  <div class="bet-options">
                    <button class="btn btn-primary" onclick="placeBet('Leicester City')">Leicester City <br>
                      5.14</button>
                    <button class="btn btn-warning" onclick="placeBet('Draw')">Draw <br> 9.00</button>
                    <button class="btn btn-danger" onclick="placeBet('Atletico')">Atletico <br> 27.13</button>
                  </div>
                  <div class="extra-info">+32</div>
                </div>
                <div class="match-row">
                  <div class="team-name">
                    <img src="https://via.placeholder.com/20" alt="icon"> Paris Saint-Germain vs Cardiff City
                  </div>
                  <div class="bet-options">
                    <button class="btn btn-primary" onclick="placeBet('Paris Saint-Germain')">Paris SG <br>
                      7.77</button>
                    <button class="btn btn-warning" onclick="placeBet('Draw')">Draw <br> 10.00</button>
                    <button class="btn btn-danger" onclick="placeBet('Cardiff City')">Cardiff City <br> 4.21</button>
                  </div>
                  <div class="extra-info">+24</div>
                </div>
                <div class="match-row">
                  <div class="team-name">
                    <img src="https://via.placeholder.com/20" alt="icon"> Stoke City vs Newcastle United
                  </div>
                  <div class="bet-options">
                    <button class="btn btn-primary" onclick="placeBet('Stoke City')">Stoke City <br> 3.57</button>
                    <button class="btn btn-warning" onclick="placeBet('Draw')">Draw <br> 22.00</button>
                    <button class="btn btn-danger" onclick="placeBet('Newcastle United')">Newcastle <br> 48.12</button>
                  </div>
                  <div class="extra-info">+19</div>
                </div>
              </div>
            </li>
          </ul>
        </div>

      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

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

</html>