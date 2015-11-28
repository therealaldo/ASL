<?php


class GetSessionID{
    public function request() {
        require_once(dirname(__FILE__)."/../Entities/keys.php");
        require_once(dirname(__FILE__)."/../Entities/eBaySession.php");
        $verb = "GetSessionID";
        $request_string = file_get_contents("http://".$_SERVER['SERVER_NAME']."/xml/GetSessionID.xml");
        $session = new eBaySession($userToken, $devID, $appID, $certID, $serverUrl, $compatabilityLevel, $siteID, $verb);
        $response = $session->sendHttpRequest($request_string);
        return $response;
    }
    public function response() {
        require_once(dirname(__FILE__)."/../Entities/util.php");
        $response_object = simplexml_load_string($this->request());
        $response_array = objectsIntoArray($response_object);
        return $response_array;
    }
}
?>
