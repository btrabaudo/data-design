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
        throw(new \InvalidArgumentException("id cannot be empty or negative", 405));
    }


    if ($method === "GET") {
        // set the XSRF cookie
        setXsrfCookie();

        //get a specific product or all the products or update or reply
        if(empty($id) === false) {
            $profile = Profile::getProfilebyProfileId($pdo, $id);
            if ($profile !== null) {
                $reply->data = $profile;
            }
        } else if(empty($profileAtHandle) === false) {
            $profile = Profile::getProfileByProfileAtHandle($pdo, $profileAtHandle)->toArray();
            if ($profile !== null) {
                $reply->data = $profile;
            }
        } else if(empty($profileEmail) === false) {
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

        $requestContent = file_get_contents("php://input");

        // Gets the JSON package that the user sent, and stores it in $requestContent. THe php://input will get the request. file_get_contents is a php function that reads a file INTO a string. In this case it will read into php://input. This is a read only stream that takes the data from the front end. In this case it is a JSON package but presumably it could be another kind.

        $requestObject = json_decode($requestContent);
          // the above line decodes the JSON package and puts it in the variable $requestContent

        if(empty($requestObject->profileEmail) === true) {
                throw(new \InvalidArgumentException("No at handle for profile", 405));
        }

        if(empty($requestObject->profileId) === true) {
            throw(new \InvalidArgumentException ("No Profile Id", 405));
        }

        // preforms the put or post
        if($method === "PUT") {

            // retrieve the email to update
            $profile = Profile::getProfileByProfileId ($pdo, $id);
            if($profile === null) {
                    throw(new \RuntimeException("Profile does not exist", 404));
            }

            // enforce user authentication

            if(empty ($_SESSION["profile"]) === true) {
                throw (new \InvalidArgumentException("You are not allowed to edit this profile", 403));
            }

            // update all the attributes
            $profile->setProfileEmail($requestObject->profileEmail);
            $profile->update($pdo);

            // update reply
            $reply->message = "Profile Updated";
        } else if($method === "POST") {

            //enforce user authentication
            if(empty($_SESSION ["profile"]) === true) {
                    throw(new \InvalidArgumentException("You must login to edit a profile", 403));
            }

                // create new profile and put in dataabse
                $profile = new Profile(null, $requestObject->profileId, $requestObject->profileEmail, null);
                $profile->insert($pdo);

                //update and reply
                $reply->message = "Profile created";
        }


    } else if($method === "DELETE") {

        // enforce XSRF token
        verifyXsrf();

        // retrieve the Profile to be deleted
        $profile = Profile::getProfileByProfileId($pdo, $id);
        if($profile === null) {
            throw(new \RuntimeException("Profile does not exist", 404));
        }

        // enforce user authentication

        if(empty($_SESSION["profile"]) === true) {
                throw(new \InvalidArgumentException("You are not allowed to delete this profile"));
        }

        // delete profile
        $profile->delete($pdo);

        //update reply
        $reply->message = "Profile Deleted";
    } else {
            throw (new InvalidArgumentException("Invalid HTTP method Request"));
    }

    // update the $reply->status $reply->message

} catch(\Exception | \TypeError $exception) {
        $reply->status = $exception->getCode();
        $reply->message = $exception->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
        unset($reply->data);
}

// encode and return to user
echo json_encode($reply);
