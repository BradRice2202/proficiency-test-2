<?php
    // $fields = ["Id","Name","Surname","Initials","Age","DateOfBirth"];
    $names = ["Bradley","Gavin","Nick","Alexis","Pierre","Tom","Aran","Luke","Allison","Martin","Caelan","Aston","Wielie","Cameron","Jeanette","Jude","Danny","Thomas","James","Jake"];
    $surnames = ["Rice","Burns","Poon","Strouthos","Van De Merwe","Brooks","Groesbeek","Greenburg","Botha","Johston","Black","Miles","West","North","Ocean","Banks","Creed","Tracey","John","Cash"];
    $id = 1;
    $test = 0;
    $first = true;

    // $amountOfRecords = $_POST["amtRecords"];

    // if(array_key_exists('csv-file-from-browse', $_POST))
    // {
        $row = 1;
        if(($handle = fopen("output.csv", "r")) !== FALSE)
        {
            while(($data = fgetcsv($handle, 100, ",")) !== FALSE)
            {
                $num = count($data);
                echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                for($c=1; $c < $num; $c++)
                {
                    echo $data[$c]."<br />\n";
                };
            };
            fclose($handle);

            exit;
        };
        // echo"<pre>";
        // print_r($_FILES);
        // exit;
    // };

    function read_csv($fileName, $length)
    {

        print_r($_FILES[0]);
        exit();

        $file = fopen($_FILES[$fileName]["tmp_name"], "r");

        $headers = fgetcsv($file, $length,",");

        while(($data = fgetcsv($file, $length,",")) !== FALSE)
        {
            print_r($data[1]);
        };

    };

    function add_quotes($str)
        {
            return sprintf('"%s"',$str);
        };

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

                while($test >= 20)
                {
                    $test = 0;   
                };

                if($amountOfRecords <= 1){
                    array_unshift($finalArr, $fields);
                    break;
                };

                $file = 'output/output.csv';

                if($first)
                {
                    array_unshift($finalArr, $fields);
                }
                

                foreach($finalArr as $d)
                {                      
                    $csv = implode(',', array_map("add_quotes",$d));
                    file_put_contents($file,$csv."\r\n", FILE_APPEND);
                    $first = false;
                }

                
            };
            
             
        };

        $urlFile = "127.0.0.1:2020/PROFICIENCY-TEST-2/output/output.csv";
        $urlFile = "output/output.csv";
        $fileName = basename($urlFile);
        $fn = file_put_contents($fileName,file_get_contents($urlFile));
        header("Expires:0");
        header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-type: text/csv");
        header('Content-length: '.filesize($fileName));
        header('Content-disposition: attachment; filename="'.basename($fileName).'"');
        readfile($fileName);
        // header('Location: ' . $_SERVER['HTTP_REFERER']);

    