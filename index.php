<?php

session_start();

$fields = ["Id","Name","Surname","Initials","Age","DateOfBirth"];
$names = ["Bradley", "Gavin", "Nick", "Alexis", "Pierre", "Tom", "Aran", "Luke", "Allison", "Martin", "Caelan", "Aston", "Wielie", "Cameron", "Jeanette", "Jude", "Danny", "Thomas", "James", "Jake"];
$surnames = ["Rice", "Burns", "Poon", "Strouthos", "Van De Merwe", "Brooks", "Groesbeek", "Greenburg", "Botha", "Johston", "Black", "Miles", "West", "North", "Ocean", "Banks", "Creed", "Tracey", "John", "Cash"];
$id = 1;
$amt = 0;

$dbFile = 'sqliteDB/database.db';
$db = new PDO("sqlite:sqliteDB/database.db");

// $row = 0;

if(isset($_POST["csv-file-from-browse"])){

    $filePath = $_FILES['uploadedCsv']['tmp_name'];

    $csvFile = fopen("$filePath",'r');

    while(($data = fgetcsv($csvFile)) !== FALSE){
        $array[] = $data;
    };
    for($z = 0; $z < $_SESSION['amtRec']; $z++)
    {
        $qry = $db->prepare(
            'INSERT or IGNORE INTO Persons (Id, Name, Surname, Initials, Age, DateOfBirth) VALUES (?,?,?,?,?,?)');
        $qry->execute(array($array[$z][0],$array[$z][1],$array[$z][2],$array[$z][3],$array[$z][4],$array[$z][5]));

    };

    fclose($csvFile);

    header('Location: index.html?db=added');
    
};

function add_quotes($str)
{

    // $fileurl = "127.0.0.1/output/output.csv";

    return sprintf('"%s"', $str);
};

if (isset($_POST['submitAmtRecords'])) {

    $qry = $db->prepare(
        'CREATE TABLE Persons(Id INT PRIMARY KEY,Name VarChar(20) NOT NULL,Surname VarChar(20) NOT NULL,Initials VarChar(5) NOT NULL,Age INT,DateOfBirth VarChar(20));');
    $qry->execute();

    $amountOfRecords = intval($_POST["amtRecords"]);

    $lastNameAmt = 0;

    $_SESSION['amtRec'] = $amountOfRecords;

    while ($id <= $amountOfRecords) {
        $lastName = $surnames;

        foreach ($names as $name) {

            $currentTime = time();

            $currentDate = gmdate("d-m-y", $currentTime);

            $date_string = mt_rand(1262055681, $currentTime);

            $birthdate = date("d-m-y", $date_string);

            $birthYear = intval(date("y", $date_string));

            $yearNow = intval(date("y", $currentTime));

            $age = $yearNow - $birthYear;

            $person = [];

            $person = [$id, $name, $lastName[$lastNameAmt], substr($name, 0, 1), $age, $birthdate];

            $finalArr = array();

            array_push($finalArr, $person);

            $file = 'output/output.csv';

            foreach ($finalArr as $d) {
                $csv = implode(',', array_map("add_quotes", $d));
                file_put_contents($file, $csv . "\r\n", FILE_APPEND);
                $urlFile = "127.0.0.1:2000/output.csv";
                $urlFile = "output.csv";
                $fileName = basename($urlFile);
                $fn = file_put_contents($fileName, file_get_contents($file));
            }

            $id++;
            $amt++;
            $lastNameAmt++;

            while($lastNameAmt >= 20){
                $lastNameAmt = mt_rand(1,20);
            };

            if ($amt >= $amountOfRecords) {
                exit;
            }
            header('Location: index.html?csv='.$amountOfRecords);
        };
    };
    header('Location: index.html?csv='.$amountOfRecords);
};

if(isset($_POST["resetBtn"])){

    unlink("output.csv");
    file_put_contents("output/output.csv","");

    $qry = $db->prepare(
        'DROP TABLE Persons');
    $qry->execute();

    header('Location: index.html');

};