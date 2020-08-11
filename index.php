<?php 
require_once "migration.php";
session_start();
?>

<html>

<head>
    <title>4cd32d6e</title>
    
</head>
<style>
    body{
        background-color:brown;
    }
    h1{
        text-align: center;
        color:aliceblue;
        font-size: 70px;
    }
    .login{
        text-decoration: wavy;
        font-size: 20px;
        text-align: center;
        color: yellow;
        border: 2px black solid;
        padding: 5px;
        margin-left: 500px;
    }
    .table-a{
        text-decoration: underline;
        font-size: 50px;
        text-align: center;
        color:aqua;
        padding: 5px;
      
    }
.table{
    margin-top: 10px;
}
</style>

<body>
    <h1>T.D.M Perera resume registry</h1>
    
    <a class="login" href="login.php">please log in</a>
    <?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
echo('<table class="table" border="1" align="center">'."\n");
echo "<tr><th>Name</th><th>Headline</th></tr>";
$stmt = $db->query("SELECT first_name, headline, summary,profile_id FROM profile where profile_id");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo('<a class="table-a"  href="view.php?profile_id='.$row['profile_id'].'">'.htmlentities($row['first_name']).'</a>  ');
   
    echo("</td><td>");
    echo(htmlentities($row['headline']));
    echo("</td><td>");
  
  
    echo("</td></tr>\n");
     
}
?>
</body>
</html>