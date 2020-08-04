<?php
session_start();

echo '
    <!-- Required meta tags -->
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
';
$link = new mysqli("localhost", "reservation_root", 
    "AbduAlawini", "reservation_schema");

if ($link->connect_errno) {
    printf("Connection failed: %s\n", $con->connect_error());
    exit();
}

echo '
<nav class="navbar navbar-expand-lg navbar-light"  style="background-color: snow;">
  <a class="navbar-brand" href="index.php">CampusReservations</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!--<li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>-->
      <!--<li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reservations
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="create_reservation.php">Make Reservation</a>
          <a class="dropdown-item" href="view_reservations.php">View Reservations</a>
        </div>
      </li>';
      
    if (isset($_SESSION['NetID']) && $_SESSION['NetID'] != "") {
        echo '<li class="nav-item">
            <a class="nav-link" href="availability.php">Recommendations</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="campus_stats.php">Campus Stats</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="user_stats.php">User Stats</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="health.php">Covid Tracking</a>
        </li>
        
        </ul>';
    } else {
        echo '</ul>';
    }
    
    
    if (!isset($_SESSION['NetID']) || $_SESSION['NetID'] == "") {
        echo '<button class="btn btn-outline-primary" type="button" onclick="window.location=\'login.php\'">Sign In</button>&nbsp;
        <button class="btn btn-outline-primary" type="button" onclick="window.location=\'create_user.php\'">Register</button>';
    } else {
        $query = "SELECT FirstName FROM Student WHERE NetID = '" . $_SESSION['NetID'] . "'";
        
        $result = $link->query($query);
        
        $name = '';
        
        while ($row = $result->fetch_row()) {
            $name = $row[0];
        }
        
        echo '<span class="navbar-text">
            Hello '.$name.'!&nbsp&nbsp
        </span>
        <button class="btn btn-outline-primary" type="button" onclick="window.location=\'logout.php\'">Log Out</button>';
    }
  
echo    '</div>
</nav>';

function close() {
    mysqli_close($link);
    echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>';
}

function saltAndHash($pass) {
    return hash('sha256', '%G&a$mm,'.$pass.'@$&dsR!');
}

function setTabTitle($given_title) {
    echo "<head><title>$given_title</title>";
    echo "<link rel='shortcut icon' href='illini_icon.ico' type='image/x-icon' /></head>";
}
?>