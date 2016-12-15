<!DOCTYPE html>
<?php
error_reporting(0);
session_start();

$infoResult = "";
$column = 0;

if($_SESSION['access'] != 1){
    header("location:index.php");
}
else{
$servername = $_SESSION['hostID'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];

$conn = mysql_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysql_connect_error());
}
else{
    $infoResult = "It Works!";
}

if (isset($_POST['enterCommand'])) {
    $sql = $_POST['command'];
    $sql = $sql;
    $result = mysql_query($sql);
    
if (!$result) {
    $infoResult =  "DB Error, could not list tables\n";
    $infoResult =  'MySQL Error: ' . mysql_error();
    exit;
}
else{
    $column = mysql_num_fields($result);
    $infoResult = "<table cellpadding='10px' cellspacing='5px' width='100%'><tr><td style='background-color: #ffcc00'><strong>Recent Query:</strong></br>".$sql."</td></tr></table><br/>";
    $infoResult = $infoResult."<table cellpadding='5px' cellspacing='5px'><tr>";
    for($a = 0; $a<=$column; $a++){
        $infoResult = $infoResult ."<td style='background-color: #ffcc00; text-align:center; color:#ffffff;'><strong>".  mysql_field_name($result, $a) ."</strong></td>";
    }
    $infoResult = $infoResult."</tr><tr>";
    
    while ($row = mysql_fetch_row($result)) {
            for($a = 0; $a<=$column; $a++){
                if($a < $column){
                 $infoResult = $infoResult ."<td style='background-color: #eaeaea;'>{$row[$a]}" ."</td>";   
                }
                else{
                 $infoResult = $infoResult ."<td style='background-color: #eaeaea;'>{$row[$a]}" . "</td></tr><tr>";   
                }
            }
}
$infoResult = $infoResult."</tr></table>";
}
mysql_free_result($result);
}
}

?>
<html>
    <head>
        <title>PHP - MySQL Query Browser</title>
    </head>
    <body style="font-family: Arial; font-size: 12px;">
        <div>
            <form action="" method="POST">
                            <textarea name="command" id="command" rows="4" cols="50" style="width: 100%;"></textarea>
                            <br/>
                            <br/>
                            <input type="submit" name="enterCommand" id="enterCommand" value="Send Query">
                        </form>
            <br/><a href="clear.php"><button>Clear Data</button></a>
        </div>
        <hr width="100%"/>
        <div style="padding-top: 20px;">
            <?php echo $infoResult; ?>
        </div>
    </body>
</html>