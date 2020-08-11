<?php
require_once "migration.php";
session_start();
?>
<html>
<head></head>
<style>
    

    </style>
<body>
<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
if (!isset($_GET['profile_id'])){
    $_SESSION['error'] = "Missing profile_id";
    header('Location: index.php');
    return;
  }

$stmt = $db->prepare("SELECT * FROM profile where profile_id =:xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    $_SESSION['error'] = 'Bad value for profile_id';
    header('Location: view.php') ;
    return;
}

// Flash pattern
if (isset($_SESSION['error'])) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$fn = htmlentities($row['first_name']);
$ln = htmlentities($row['last_name']);
$e = htmlentities($row['email']);
$he = htmlentities($row['headline']);
$su = htmlentities($row['summary']);
$pid = $row['profile_id'];

?>

<h1><?= $fn ?> profile view</h1>


<p>First Name:
<b><?= $fn ?></b></p>
<p>Second Name:
<b><?= $ln ?></b></p> 
<p>Email:
<b><?= $e ?></b></p>
<p>Headline:
<b><?= $he ?></b></p>
<p>Summary:
<b name="summary" ><?= $su ?> </b></p>
<b type="hidden" name="profile_id" <?= $pid ?>>


<a href="index.php">Cancel</a></p>

