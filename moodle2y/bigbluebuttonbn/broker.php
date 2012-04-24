<?php
/**
 * View and administrate BigBlueButton playback recordings
 *
 * Authors:
 *    Jesus Federico  (jesus [at] blindsidenetworks [dt] com)    
 *
 * @package   mod_bigbluebuttonbn
 * @copyright 2011-2012 Blindside Networks Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v2 or later
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

require_login();

$salt = trim($CFG->BigBlueButtonBNSecuritySalt);
$url = trim(trim($CFG->BigBlueButtonBNServerURL),'/').'/';

if( !($action = optional_param('action', 0, PARAM_TEXT)) ) $action="version";

switch ($action) {
    case "publish":
        $recordingID = optional_param('recordingID', 0, PARAM_TEXT);
        if( $recordingID ){
        	if (BigBlueButtonBN::setPublishRecordings($recordingID, 'true', $url, $salt)) {
                echo "Success";
        	} else {
                echo "Failed";
        	}
        } else {
            echo 'No recordingID';
        }	
        break;
    case "unpublish":
        $recordingID = optional_param('recordingID', 0, PARAM_TEXT);
        if( $recordingID ){
        	if (BigBlueButtonBN::setPublishRecordings($recordingID, 'false', $url, $salt)) {
                echo "Success";
        	} else {
                echo "Failed";
        	}
        } else {
            echo 'No recordingID';
        }	
        break;
    case "delete":
        $recordingID = optional_param('recordingID', 0, PARAM_TEXT);
        if( $recordingID ){
        	if (BigBlueButtonBN::deleteRecordings($recordingID, $url, $salt)) {
                echo "Success";
        	} else {
                echo "Failed";
        	}
        } else {
            echo 'No recordingID';
        }	
        break;

    case "ping":
        if( $meetingID = optional_param('meetingID', 0, PARAM_TEXT) ){
            echo BigBlueButtonBN::getMeetingXML( $meetingID, $url, $salt );
        } else {
            echo 'false'';
        }
        break;
        
    default:
        echo BigBlueButtonBN::getServerVersion($url);
}


?>
