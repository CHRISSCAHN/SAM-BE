<?php
include("connect.php");
include("personality.php");

$personalities = array();

$applianceQuery = "
    SELECT 
        iop.islandOfPersonalityID AS islandID,
        iop.name AS islandName,
        iop.shortDescription AS islandShortDescription,
        iop.longDescription AS islandLongDescription,
        iop.color AS islandColor,
        iop.image AS islandImage,
        iop.status AS islandStatus,
        icpost.islandContentID AS contentID,
        icpost.image AS contentImage,
        icpost.content AS contentText,
        icpost.color AS contentColor
    FROM 
        islandsOfPersonality AS iop
    JOIN 
        islandContents AS icpost
    ON 
        iop.islandOfPersonalityID = icpost.islandOfPersonalityID
";

$applianceResult = executeQuery($applianceQuery);

// Fetch data and populate the personalities array
while ($applianceRow = mysqli_fetch_assoc($applianceResult)) {
    $a = new personality(
        $applianceRow['islandName'],
        $applianceRow['islandID'],
        $applianceRow['islandShortDescription'],
        $applianceRow['islandLongDescription'],
        $applianceRow['islandColor'],
        $applianceRow['islandImage'],
        $applianceRow['islandStatus'],
        $applianceRow['contentImage'],
        $applianceRow['contentText'],
        $applianceRow['islandColor']
    );

    array_push($personalities, $a);
}
shuffle($personalities);
$accorddaw = array();

$appliancesQuery = "
    SELECT 
        iop.islandOfPersonalityID AS islandID,
        iop.name AS islandName,
        iop.shortDescription AS islandShortDescription,
        iop.longDescription AS islandLongDescription,
        iop.color AS islandColor,
        iop.image AS islandImage,
        iop.status AS islandStatus,
        icpost.islandContentID AS contentID,
        icpost.image AS contentImage,
        icpost.content AS contentText,
        icpost.color AS contentColor
    FROM 
        islandsOfPersonality AS iop
    JOIN 
        islandContents AS icpost
    ON 
        iop.islandOfPersonalityID = icpost.islandOfPersonalityID
        
    GROUP by islandName
";

$appliancesResult = executeQuery($appliancesQuery);

// Fetch data and populate the personalities array
while ($appliancesRow = mysqli_fetch_assoc($appliancesResult)) {
    $b = new personality(
        $appliancesRow['islandName'],
        $appliancesRow['islandID'],
        $appliancesRow['islandShortDescription'],
        $appliancesRow['islandLongDescription'],
        $appliancesRow['islandColor'],
        $appliancesRow['islandImage'],
        $appliancesRow['islandStatus'],
        $appliancesRow['contentImage'],
        $appliancesRow['contentText'],
        $appliancesRow['islandColor']
    );

    array_push($accorddaw, $b);
}
shuffle($accorddaw);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHANCHAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href="style.css" rel="stylesheet">
</head>

<body>

   
    <div class="container-fluid mt-3 pt-3 mb-5 pb-4">
        <div class="row">
            <div class="col-md-3">
                <!-- ung profile -->
                <div class="card">
                    <div class="card-body text-center">
                        <img src="images/chanchannnnn.jpg" class="profile-img rounded-circle mb-3" alt="Avatar">
                        <h5>My Profile</h5>
                        <hr>
                        <p><i class="fas fa-pencil-alt me-2"></i> Backend Developer</p>
                        <p><i class="fas fa-home me-2"></i> Laguna, Philippines</p>
                        <p><i class="fas fa-birthday-cake me-2"></i> September 04, 2002</p>
                    </div>
                </div>

                <!-- etoung parangf dropdown-->
                <div class="accordion" id="accordionExample">
                    <?php
                    $first = true;

                    foreach ($accorddaw as $appliance) {
                        echo $appliance->accords($first);
                        $first = false;
                    }
                    ?>
                </div>

                <!-- eto ung mga may colors -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5>Islands</h5>
                        <?php
                        foreach ($accorddaw as $appliance) {
                            echo $appliance->interest();
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- psot -->
            <div class="col-md-6">
                <!-- Status Update -->
                <div class="card">
                    <div class="card-body">
                        <textarea class="form-control status-box mb-3" placeholder="Status: Feeling Blue"
                            rows="3"></textarea>
                        <button class="btn btn-primary w-100"><i class="fas fa-pencil-alt"></i> Post</button>
                    </div>
                </div>
                <!-- iloloop koto someday -->
                <?php
                foreach ($personalities as $appliance) {
                    echo $appliance->cards();
                }
                ?>
            </div>

            <!-- kanan -->
            <div class="col-md-3" id="up">
                <!-- eto papalitn to  -->
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Upcoming Events</h5>
                        <div id="upcomingEventsCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $query = "SELECT image FROM islandcontents";
                                $result = executeQuery($query);

                                if ($result->num_rows > 0) {
                                    $isFirst = true; 
                                    while ($row = $result->fetch_assoc()) {
                                        $image = $row["image"];
                                        ?>
                                        <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>">
                                            <img src="<?php echo $image; ?>" class="img-fluid mb-3" alt="Event">
                                        </div>
                                        <?php
                                        $isFirst = false; 
                                    }
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#upcomingEventsCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#upcomingEventsCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                    </div>
                </div>
                <!--diko alam kung aalisin o hndi -->
                
            </div>
        </div>
    </div>

    <!-- soon gagawin kong footer katulad ng aken -->
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
  document.addEventListener("DOMContentLoaded", function () {
        const postCards = document.getElementById("up");

        if (window.innerWidth <= 768) {
            postCards.style.display = "none";
        } else {
            postCards.style.display = "block";
        }
  });
    </script>
</body>

</html>
