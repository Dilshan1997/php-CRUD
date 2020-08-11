<?php
require_once "migration.php";
session_start();
?>

<html>
    <head></head>
    <body>

    <?php  
    
if ( isset($_POST['first_name']) && isset($_POST['email'])
     && isset($_POST['headline'])) {

    // Data validation
    if ( strlen($_POST['first_name']) < 1 || strlen($_POST['email']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: add.php");
        return;
    }

    if ( strpos($_POST['email'],'@') === false ) {
        $_SESSION['error'] = 'Bad data';
        header("Location: add.php");
        return;
    }

    $stmt = $db->prepare('INSERT INTO profile
        (profile_id, first_name, last_name, email, headline, summary)
        VALUES ( :uid, :fn, :ln, :em, :he, :su)');
    $stmt->execute(array(
        ':uid' => $_SESSION['profile_id'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary'])
    );
    header( 'Location: profile.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

?>

<p>Add A New User</p>
<form method="post">

<p>First Name:
<input type="text" name="first_name"></p>
<p>Second Name:
<input type="text" name="last_name"></p>
<p>Email:
<input type="text" name="email" id="email"></p>
<p>Headline:
<input type="text" name="headline"></p>
<p>Summary:
<textarea name="summary">Summary</textarea></p>
<p><input type="submit" value="Add New" onclick="validation()"/>
<a href="profile.php">Cancel</a></p>
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
</body>
</html>