<?php
session_start();
include("../connect.php");
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['user_id'])) {
  header("Location: ../admin/sign-in.php");
  exit();
}
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
  <?php include('dashboardnav.php'); ?>
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
    <div class="card p-3 mt-4 ">
      <div class="row">
        <?php
        $query = "SELECT 
    team1.name AS team1_name, 
    team1.flag AS team1_flag, 
    team2.name AS team2_name, 
    team2.flag AS team2_flag, 
    m.event_name, 
    m.team1_odds, 
    m.team2_odds, 
    m.draw_odds, 
    m.game_date, 
    m.status
  FROM games m
  JOIN country team1 ON m.team1_id = team1.id
  JOIN country team2 ON m.team2_id = team2.id";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
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
          <div class="col-md-4 col-sm-6 mb-3">
            <div class="card text-white" style="background-color:#000000">
              <div class="card-header d-flex justify-content-between align-items-center p-2"style="background-color:#000000">
                <span class="badge bg-danger"><?php echo $status ?></span>
                <span class="text-muted"><?php echo $timeRemaining ?></span>
              </div>
              <div class="card-body text-center p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <img src="<?php echo $fFlag ?>" alt="Team 1" class="img-fluid" style="max-height: 50px; width: auto;">
                  <h6 class="text-uppercase m-0">vs</h6>
                  <img src="<?php echo $tFlag ?>" alt="Team 2" class="img-fluid" style="max-height: 50px; width: auto;">
                </div>
                <p class="text-muted small mb-1"><?php echo $date ?></p>
                <p class="text-uppercase fw-bold small mb-2"><?php echo $gameName ?></p>
                <div class="d-flex justify-content-between mb-1">
                  <span><?php echo $fTeam ?></span>
                  <span class="fw-bold">3</span>
                </div>
                <div class="d-flex justify-content-between">
                  <span><?php echo $lTeam ?></span>
                  <span class="fw-bold">1</span>
                </div>
              </div>
              <div class="card-footer bg-dark p-2">
                <div class="d-flex justify-content-between">
                  <button class="btn btn-secondary btn-sm w-25" data-bs-toggle="modal" data-bs-target="#betModal"
                    data-team="<?php echo $fTeam ?>" data-flag="<?php echo $fFlag ?>"
                    data-odds="<?php echo $fTeamOdds ?>">
                    <?php echo $fTeamOdds ?>
                  </button>
                  <button class="btn btn-secondary btn-sm w-25" data-bs-toggle="modal" data-bs-target="#betModal"
                    data-team="Draw" data-flag="draw-flag.png" data-odds="<?php echo $drawOdds ?>">
                    <?php echo $drawOdds ?>
                  </button>
                  <button class="btn btn-secondary btn-sm w-25" data-bs-toggle="modal" data-bs-target="#betModal"
                    data-team="<?php echo $lTeam ?>" data-flag="<?php echo $tFlag ?>"
                    data-odds="<?php echo $lTeamOdds ?>">
                    <?php echo $lTeamOdds ?>
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
    <div class="modal fade" id="betModal" tabindex="-1" aria-labelledby="betModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="betModalLabel">Place Your Bet</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalFlag" src="" alt="Team Flag" class="img-fluid mb-3" style="max-height: 50px;">
                <p class="mb-1"><strong id="modalTeam"></strong></p>
                <p class="mb-3">Odds: <strong id="modalOdds"></strong></p>
                <p>Enter Bet Amount:</p>
                <input type="number" class="form-control mb-3" placeholder="Enter amount">
                <button class="btn btn-success w-100">Confirm Bet</button>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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