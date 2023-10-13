<?php
    $fields = ["Id","Name","Surname","Initials","Age","DateOfBirth"];
    $names = ["Bradley","Gavin","Nick","Alexis","Pierre","Tom","Aran","Luke","Allison","Martin","Caelan","Aston","Wielie","Cameron","Jeanette","Jude","Danny","Thomas","James","Jake"];
    $surnames = ["Rice","Burns","Poon","Strouthos","Van De Merwe","Brooks","Groesbeek","Greenburg","Botha","Johston","Black","Miles","West","North","Ocean","Banks","Creed","Tracey","John","Cash"];
    $id = 1;
    $test = 0;
    $first = true;

    $amountOfRecords = $_POST["amtRecords"];

    function add_quotes($str)
        {

            // $fileurl = "127.0.0.1/output/output.csv";

            
            // sprintf('"%s"',$str);

            // $url = "127.0.0.1/PROFICIENCY-TEST-2/output/output.csv";
            // $ch = curl_init($url);
            // $dir = './';
            // $file_name = basename($url);
            // $save_file_loc = $dir . $file_name;
            // $fp = fopen($save_file_loc, 'wb');
            // curl_setopt($ch, CURLOPT_FILE, $fp);
            // curl_setopt($ch, CURLOPT_HEADER, 0);
            // curl_exec($ch);
            // curl_close($ch);
            // fclose($fp);

            // downloadCsv();

            // header("Content-disposition: attachment; filename=\'$fileName'");

            // header("Content-Disposition: attatchment; file_url=$fileurl");

            return sprintf('"%s"',$str);
            // sprintf('"%s"',$str);

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

                if($test <= 10)
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
                    // $urlFile = "127.0.0.1:2000/PROFICIENCY-TEST-2/output/output.csv";
                    // $urlFile = "output/output.csv";
                    // $fileName = basename($urlFile);
                    // $fn = file_put_contents($fileName,file_get_contents($urlFile));
                    // header("Expires:0");
                    // header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
                    // header("Cache-Control: no-store, no-cache, must-revalidate");
                    // header("Cache-Control: post-check=0, pre-check=0", false);
                    // header("Pragma: no-cache");
                    // header("Content-type: text/csv");
                    // header('Content-length: '.filesize($fileName));
                    // header('Location: ' . $_SERVER['HTTP_REFERER']);
                    // header('Content-disposition: attachment; filename="'.basename($fileName).'"');
                    // readfile($fileName);
                    // header('Location: ' . $_SERVER['HTTP_REFERER']);
                    $first = false;
                }
            };
             
        };

        $urlFile = "127.0.0.1:2000/PROFICIENCY-TEST-2/output/output.csv";
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
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        header('Content-disposition: attachment; filename="'.basename($fileName).'"');
        readfile($fileName);

        // $urlFile = "output/output.csv";
        // $fileName = basename($urlFile);
        // $fn = file_put_contents($fileName,file_get_contents($urlFile));
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
        // header('Content-disposition: attachment; filename="'.basename($fileName).'"');
        // readfile($fileName);


        // header('Location: ' . $_SERVER['HTTP_REFERER']);