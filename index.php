<?php
$db = new PDO("mysql:host=127.0.0.1;dbname=hospital", "root", "");

function showNurses(PDO $db)
{
    $statement = $db->query("SELECT DISTINCT name FROM nurse");
    while ($data = $statement->fetch()) {
        echo "<option value='$data[0]'>$data[0]</option>";
    }
}

function showWards(PDO $db)
{
    $statement = $db->query("SELECT DISTINCT ID_Ward FROM ward");
    while ($data = $statement->fetch()) {
        echo "<option value='$data[0]'>$data[0]</option>";
    }
}

function addNurse($db, $name, $date, $department, $shift)
{
    $statement = $db->prepare("INSERT INTO nurse (name, `date`, department, shift) VALUES (?, ?, ?, ?)");
    $statement->execute([$name, $date, $department, $shift]);
}

function addWard($db, $ward)
{
    $statement = $db->prepare("INSERT INTO ward (ID_Ward) VALUES (?)");
    $statement->execute([$ward]);
}

function addNurseWard($db, $FID_Nurse, $FID_Ward)
{
    $statement = $db->prepare("INSERT INTO nurse_ward (FID_Nurse, FID_Ward) VALUES (?, ?)");
    $statement->execute([$FID_Nurse, $FID_Ward]);
}

if (isset($_POST["name"])) {
    addNurse($db, $_POST["name"], $_POST["date"], $_POST["department"], $_POST["addShift"]);
} elseif (isset($_POST["addWard"])) {
    addWard($db, $_POST["addWard"]);
} elseif (isset($_POST["FID_Nurse"])) {
    addNurseWard($db, $_POST["FID_Nurse"], $_POST["FID_Ward"]);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maxim</title>
    <script src="script.js"></script>
</head>
<body>
<div id="download"></div>
<br>
<form action="" method="post" id="ward">
    <select name="nurse">
        <?php
        showNurses($db);
        ?>
    </select>
    <input type="submit" value="Enter"><br>
</form>
<br>
<form action="" method="post" id="nurse">
    <select name="ward">
        <?php
        showWards($db);
        ?>
    </select>
    <input type="submit" value="Enter"><br>
</form>
<br>
<form action="" method="post" id="duty">
    <select name="shift">
        <option value="First">First</option>
        <option value="Second">Second</option>
        <option value="Third">Third</option>
    </select>
    <input type="submit" value="Enter"><br>
</form>
<br>
<form action="" method="post">
    <input type="text" name="name" placeholder="Add Nurse Name"><br>
    <input type="date" name="date" placeholder="Add Nurse Date"><br>
    <input type="text" name="department" placeholder="Add Nurse Department"><br>
    <input type="text" name="addShift" placeholder="Add Nurse Shift"><br>
    <input type="submit" value="Enter"><br>
</form>
<br>
<form action="" method="post">
    <input type="number" name="addWard" placeholder="Add Ward"><br>
    <input type="submit" value="Enter"><br>
</form>
<br>
<form action="" method="post">
    <input type="text" name="FID_Nurse" placeholder="Add Nurse"><br>
    <input type="text" name="FID_Ward" placeholder="Add Ward"><br>
    <input type="submit" value="Enter"><br>
</form>
</body>
</html>
