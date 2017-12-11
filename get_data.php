<?
    header('content-type:application/json');
    function chiamata_api($url)
    {
        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);
        return $result;

    }
    if(isset($_GET["query"])&&!empty($_GET["query"]))
		$query=$_GET["query"];
    else
        $query='pizza';

    if(isset($_GET["near"])&&!empty($_GET["near"]))
		$near=$_GET["near"];
    else
        $near='bergamo';

    if(isset($_GET["limit"])&&!empty($_GET["limit"]))
		$limit=$_GET["limit"];
    else
        $limit='10';

    $client_id=[YOUR FOURSQUARE CLIENT ID HERE];
    $client_secret=[YOUR FOURSQUARE CLIENT SECRET HERE];
    $url_ricerca_venues="https://api.foursquare.com/v2/venues/search?near=$near&query=$query&client_id=$client_id&client_secret=$client_secret&v=20171109&limit=$limit";

    $json_result=chiamata_api($url_ricerca_venues);
    $data_result=json_decode($json_result, true);
    $data_result = $data_result["response"];
    $data_result = $data_result["venues"];
    echo json_encode($data_result);
    
?>