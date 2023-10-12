<?php
    $names = ["Bradley","Gavin","Nick","Alexis","Pierre","Tom","Aran","Luke","Allison","Martin","Caelan","Aston","Wielie","Cameron","Jeanette","Jude","Danny","Thomas","James","Jake"];
    $surnames = ["Rice","Burns","Poon","Strouthos","Van De Merwe","Brooks","Groesbeek","Greenburg","Botha","Johston","Black","Miles","West","North","Ocean","Banks","Creed","Tracey","John","Cash"];

    // header("Content-type: text/csv");

    // $filename = "people.csv";

    // header("Content-Disposition: attachment; filename = $filename");

    $output = fopen("php://output" , "w");

    foreach ($names as $name)
    {
        foreach ($surnames as $surname)
        {
            $person = [];

            $date_string= mt_rand(1262055681,1262055681);

            $birthdate = date("D-m-y", $date_string);

            $person = [$name, $surname, substr($name, 0, 1), $birthdate];

            echo'<pre>';
            print_r($person);

            // $header = array_keys($person[0]);

            // fputcsv($output, $header);

            // foreach($person as $row)
            // {
                // fputcsv($output, $row);
            // };

            // fclose($output);

        };
    };

    


?>