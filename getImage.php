
<?php

    // This is the client portion of the ProfileImageFinder project. It's just PHP and HTML calling itself after
    // an email address has been passed in through the form. Some data sanitizing is being done.

    session_start();

    include_once('Services/ImageService.php');

    $email_address = getInput($_POST["email_address"]);

?>

    <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table align=center>
        <tr>
            <td>Email Address:</td>
            <td><input type = "text" name = "email_address">
            </td><td><input type = "submit" name = "submit" value = "Submit"></td>
        </tr>
    </table>
    </form>

<?php

    // check session data to see if we've already done this lookup
    if (isset($_SESSION[$email_address])) {
        $photo_url = $_SESSION[$email_address];
    } else {
        $lookup = new ImageService();
        $photo_url = $lookup->lookupByEmail($email_address);
    }

    if (!$photo_url) {
        echo "<table align=center><td>";
        echo "We were unable to find any photos to display for $email_address. Please verify the email address and resubmit";
        echo "</td></table>";
    } else {
        echo "<table align=center><tr><td align=center><img src=$photo_url></td></tr></table>";
        echo "<table align=center><tr><td align=center>$email_address</td></tr></table>";
    }

    // do some data sanitiing.
    function getInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>



