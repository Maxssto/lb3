<?php

$db = new PDO("mysql:host=127.0.0.1;dbname=hospital", "root", "");

function findWards($db, $nurse)
{
    $statement = $db->prepare("SELECT ID_Ward FROM ward INNER JOIN nurse_ward ON ID_Ward = FID_Ward INNER JOIN nurse ON FID_Nurse = ID_Nurse WHERE name=?");
    $statement->execute([$nurse]);
    $output = "<b>Wards:</b>";
    while ($data = $statement->fetch()) {
        $output .= "<br>{$data['ID_Ward']}";
    }
    echo $output;
}

function findNurses($db, $ward)
{
    $statement = $db->prepare("SELECT name FROM ward INNER JOIN nurse_ward ON ID_Ward = FID_Ward INNER JOIN nurse ON FID_Nurse = ID_Nurse WHERE ID_Ward=?");
    $statement->execute([$ward]);
    $output = "<b>Nurses:</b>";
    while ($data = $statement->fetch()) {
        $output .= "<br>{$data['name']}";
    }
    echo json_encode($output);
}

function findShift($db, $shift)
{
    $statement = $db->prepare("SELECT name, `date`, department, shift, GROUP_CONCAT(ID_Ward SEPARATOR ' ') AS 'ward'
FROM ward INNER JOIN nurse_ward ON ID_Ward = FID_Ward INNER JOIN nurse ON FID_Nurse = ID_Nurse 
WHERE shift=?
GROUP BY name");
    $statement->execute([$shift]);
    $output = "<b>Shifts:</b>";
    while ($data = $statement->fetch()) {
        $output .= "<br>{Name - {$data['name']}} {Date - {$data['date']}} {Department - {$data['department']}} {Ward - {$data['ward']}}";
    }
    echo $output;
}

if (isset($_POST["nurse"])) {
    findWards($db, $_POST["nurse"]);
} elseif (isset($_POST["ward"])) {
    findNurses($db, $_POST["ward"]);
} elseif (isset($_POST["shift"])) {
    findShift($db, $_POST["shift"]);
}

