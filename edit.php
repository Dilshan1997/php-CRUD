<?php

require_once "migration.php";
session_start();

if (isset($_POST['first_name']) && isset($_POST['email'])
     && isset($_POST['headline']) && isset($_POST['profile_id'])) {

    // Data validation
    if ( strlen($_POST['first_name']) < 1 || strlen($_POST['email']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: edit.php?profile_id=".$_POST['profile_id']);
        return;
    }

    $sql = "UPDATE profile SET 'first_name = :fn','last_name = :ln', 'email = :em','headline=:he','summary=:su' WHERE 'profile_id =:pid'";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
        ':pid' => $_SESSION['profile_id'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary']));
    $_SESSION['success'] = 'Record updated';

    header('Location: profile.php');
    return;
}

// Guardian: Make sure that profile_id is present
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
    header('Location: profile.php') ;
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
<p>Edit User</p>
<form method="post">

<p>First Name:
<input type="text" name="first_name"value=<?= $fn ?>></p>
<p>Second Name:
<input type="text" name="last_name" value=<?= $ln ?>></p>
<p>Email:
<input type="text" name="email" id="email" value=<?= $e ?>></p>
<p>Headline:
<input type="text" name="headline" value=<?= $he ?>></p>
<p>Summary:
<textarea name="summary" ><?= $su ?> </textarea></p>
<input type="hidden" name="profile_id" value=<?= $pid ?>>

<p><input type="submit" value="Update" onclick="validation()"/>
<a href="view.php">Cancel</a></p>
</form>

<script>

    function validation() {

var email = document.getElementById('email');
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

if (!filter.test(email.value)) {
alert('Please provide a valid email address');
email.focus;
return false;
}
    }
</script>
