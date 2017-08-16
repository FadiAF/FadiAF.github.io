 <?php
     $summonerName = $_GET['summ'];
     
    $region = "eun1"; //https://developer.riotgames.com/regional-endpoints.html
    
    $apiKey = "RGAPI-5a9688ae-8d18-4aa4-98f1-ba870c691eaa";
     
    // PART I. OBTAIN SUMMONERID
     
    // construct url to grab the summonerId
    $summonerURL = "https://". $region . ".api.riotgames.com/lol/summoner/v3/summoners/by-name/". $summonerName ."?api_key=". $apiKey;
     
    // grab the results from the url, this will be in a JSON format
    $summonerResult = file_get_contents($summonerURL);
     
    // Take the result (JSON encoded string) and converts it into a PHP variable. 
    $summonerDecoded = json_decode($summonerResult, true);
     
    // to output the associative arrays uncomment the next 2 lines
    // echo "<pre>"; // this line will make your array more readable
    // print_r($summonerDecoded); //out put your array
     
     
     
    // PART II. GET RANK INFORMATION
     
    $summonerId = $summonerDecoded['id'];
     
    // construct url to grab the rank information
    $rankInfoURL = "https://". $region . ".api.riotgames.com/lol/league/v3/positions/by-summoner/". $summonerId ."?api_key=". $apiKey;
     
    // grab the results from the url, this will be in a JSON format
    $rankInfoResult = file_get_contents($rankInfoURL);
     
    // Take the result (JSON encoded string) and converts it into a PHP variable. 
    $rankInfoDecoded = json_decode($rankInfoResult, true);
     
    // to output the associative arrays uncomment the next 2 lines
    // echo "<pre>"; // this line will make your array more readable
    // print_r($rankInfoDecoded); //out put your array
     
     
    // PART III. Transform the data into information
     
    $tier = $rankInfoDecoded[0]['tier'];
    $rank = $rankInfoDecoded[0]['rank'];
    
    $champMastURL = "https://". $region . ".api.riotgames.com//lol/champion-mastery/v3/scores/by-summoner/". $summonerId ."?api_key=". $apiKey;
     
    $champMastResult = file_get_contents($champMastURL);
    
    $champMastDecode = json_decode($champMastResult, true);
    
    echo $summonerName ." is <br>". '<img src="/'.$tier.'.png">' ." ". $rank."<br> Total Mastery Points: ".$champMastDecode ; // just kidding ofcourse
     
    ?>