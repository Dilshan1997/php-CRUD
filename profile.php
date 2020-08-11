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
echo('<table border="1" center>'."\n");
$stmt = $db->query("SELECT first_name, headline, summary,profile_id FROM profile");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['first_name']));
    echo("</td><td>");
    echo(htmlentities($row['headline']));
    echo("</td><td>");
    echo(htmlentities($row['summary']));
    echo("</td><td>");
    echo('<a href="edit.php?profile_id='.$row['profile_id'].'">Edit</a> / ');
    echo('<a href="delete.php?profile_id='.$row['profile_id'].'">Delete</a>');
    echo("</td></tr>\n");
    
}
?>
</table>
<a href="add.php">Add New</a>
<a href="logout.php">Log Out</a>

