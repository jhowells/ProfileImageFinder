<?php

    include_once('Services/ImageService.php');

    $email_address = getInput($_POST["email_address"]);

?>

    <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table>
        <tr>
            <td>Email Address:</td>
            <td><input type = "text" name = "email_address">
            </td>
        </tr>
        <tr>
            <td>
                <input type = "submit" name = "submit" value = "Submit">
            </td>
        </tr>
    </table>
    </form>

<?php

    $lookup = new ImageService();

    list($result, $fullName) = $lookup->lookupByEmail($email_address);
    if (!$result) {
        echo "We were unable to find any photos to display for $email_address. Please verify the email address and resubmit.<br>";
    } else {
        echo "<table align=center><tr><td align=center><img src=$result></td></tr></table>";
        echo "<table align=center><tr><td align=center>$fullName</td></tr></table>";
    }

    // do some data sanitiing.
    function getInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

