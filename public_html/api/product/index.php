<?php

require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");


/**
 * api for product class
 *
 * @author qed
 *
 */

if(session_status() !== PHP_SESSION_ACTIVE) {
    session_status();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
    $pdo = connectToEncryptedMySQL("INSERT PATH HERE");

    $method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

    //sanitize input
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    $profileId = filter_input(INPUT_GET, "profileId", FILTER_SANITIZE_NUMBER_INT);
    $profileEmail = filter_input(INPUT_GET, "profileEmail", FILTER_SANITIZE_EMAIL);

    // check the validity of id for methods that require it
    If(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
        throw(new InvalidArgumentException("id cannot be empty or negative", 405));
    }


    if ($method === "GET") {
        // set the XSRF cookie
        setXsrfCookie();

        //get a specific product or all the products or update or reply
        if (empty($id) === false) {
            $profile = Profile::getProfilebyProfileId($pdo, $id);
            if ($profile !== null) {
                $reply->data = $profile;
            }
        } else if (empty($profileAtHandle) === false) {
            $profile = Profile::getProfileByProfileAtHandle($pdo, $profileAtHandle)->toArray();
            if ($profile !== null) {
                $reply->data = $profile;
            }
        } else if (empty($profileEmail) === false) {
            $profile = Profile::getProfilebyProfileEmail($pdo, $profileEmail)->toArray();
            if ($profile !== null) {
                $reply->data = $profile;
            }
        } else {
            $profile = Profile::getAllProfiles($pdo)->toArray();
                if($profile !== null) {
                    $reply->data = $profile;
                }
        }
    }else if ($method === "PUT" || $method === "POST") {
        //enforce XSRF token
        verifyXsrf();
    }

}
