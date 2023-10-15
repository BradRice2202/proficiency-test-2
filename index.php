<?php

    session_start();

    // $fields = ["Id","Name","Surname","Initials","Age","DateOfBirth"];
    $names = ["Bradley","Gavin","Nick","Alexis","Pierre","Tom","Aran","Luke","Allison","Martin","Caelan","Aston","Wielie","Cameron","Jeanette","Jude","Danny","Thomas","James","Jake"];
    $surnames = ["Rice","Burns","Poon","Strouthos","Van De Merwe","Brooks","Groesbeek","Greenburg","Botha","Johston","Black","Miles","West","North","Ocean","Banks","Creed","Tracey","John","Cash"];
    $id = 1;
    $test = 0;
    // $first = true;
    
        $row = 0;
        if(($handle = fopen("output.csv", "r")) !== FALSE)
        {
            while(($data = fgetcsv($handle, 100, ",")) !== FALSE)
            {
                $num = count($data);
                echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                for($c=0; $c < $num; $c++)
                {
                    echo $data[$c]."<br />\n";
                };
            };
            fclose($handle);
            exit;
        };

    function add_quotes($str)
        {

            $fileurl = "127.0.0.1/output/output.csv";

            return sprintf('"%s"',$str);
        };

        if(isset($_POST['submitAmtRecords']))
        {
            $amountOfRecords = $_POST["amtRecords"];

            while($id <= $amountOfRecords)

            {
                $lastName = $surnames;
    
                foreach ($names as $name)
                {
                        
                    $currentTime = time();
    
                    $currentDate = gmdate("d-m-y", $currentTime);
    
                    $date_string= mt_rand(1262055681,$currentTime);
    
                    $birthdate = date("d-m-y", $date_string);
    
                    $birthYear = intval(date("y", $date_string));
    
                    $yearNow = intval(date("y", $currentTime));
    
                    $age = $yearNow - $birthYear;
    
                    $person = [];
                           
                    $person = [$id,$name, $lastName[$test], substr($name, 0, 1),$age, $birthdate];
    
                    $finalArr = array();
    
                    array_push($finalArr,$person);
    
                    $id++;
                    $test++;
    
                    if($test >= 20)
                    {
                        $test = 0;
                    };
    
                    // if($amountOfRecords <= 1){
                    //     array_unshift($finalArr, $fields);
                    //     break;
                    // };
    
                    $file = 'output/output.csv';
    
                    // if($first)
                    // {
                    //     array_unshift($finalArr, $fields);
                    // }
                    
    
                    foreach($finalArr as $d)
                    {                      
                        $csv = implode(',', array_map("add_quotes",$d));
                        file_put_contents($file,$csv."\r\n", FILE_APPEND);
                        $urlFile = "127.0.0.1:2000/output.csv";
                        $urlFile = "/output.csv";
                        $fileName = basename($urlFile);
                        $fn = file_put_contents($fileName,file_get_contents($file));
    
                        header("Content-Disposition: attachment; filename=$fileName");
                        // header('Location: ' . $_SERVER['HTTP_REFERER']);
                        // $first = false;
                    }
                };
                 
            };
            header("Content-Disposition: attachment; filename=$fileName");
        };

        

        // header('Location: ' . $_SERVER['HTTP_REFERER']);
        // header("Content-Disposition: attachment; filename=$fileName");
        // readfile($fileName);