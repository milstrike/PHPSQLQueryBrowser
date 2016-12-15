<!DOCTYPE html>
<?php
error_reporting(0);
session_start();
$infoResult = "";

if (isset($_POST['setDB'])) {
    $_SESSION['hostID'] = $_POST['hostID'];
    $_SESSION['username'] = $_POST['userID'];
    $_SESSION['password'] = $_POST['passID'];
    
    $conn = mysql_connect($_SESSION['hostID'], $_SESSION['username'], $_SESSION['password']);
    // Check connection
    if (!$conn) {        
        $infoResult = "Connection failed: " . mysql_connect_error();
        header("location:index.php");
    }
    else{
        $_SESSION['access'] = 1;
        header("location:main.php");
    }
}
?>
<html>
    <head>
        <title>PHP - MySQL Query Browser</title>
    </head>
    <body style="font-family: Arial; font-size: 12px;">
        <div>
            <table border="0" cellspacing="5px" cellpadding="5px">
                <form action="" method="POST">
                    <tr>
                        <td style="background-color: #ff9933"><strong>host</strong></td>
                        <td style="background-color: #ccccff"><input type="text" name="hostID" id="hostID" required/></td>
                    </tr>
                    <tr>
                        <td style="background-color: #ff9933"><strong>username</strong></td>
                        <td style="background-color: #ccccff"><input type="text" name="userID" id="userID" required/></td>
                    </tr>
                    <tr>
                        <td style="background-color: #ff9933"><strong>password</strong></td>
                        <td style="background-color: #ccccff"><input type="password" name="passID" id="passID"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="setDB" id="setDB" value="Connect DB!">
                        </td>
                    </tr>
                </form>
            </table>
        </div>
        <hr width="100%"/>
        <div style="padding-top: 20px;">
            <?php echo $infoResult; ?>
        </div>
    </body>
</html>
