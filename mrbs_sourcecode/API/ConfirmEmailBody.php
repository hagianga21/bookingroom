<?php
include "EmailBody.php";
include_once "Configuration.php";

class ConfirmEmailBody extends EmailBody
{
    private $entry;

    /**
     * ConfirmEmailBody constructor.
     * @param $entry
     */
    public function __construct($entry)
    {
        $this->entry = $entry;
    }

    function create_body()
    {
        $body ="";
        $body.="<!DOCTYPE HTML>";
        $body.="<html>";
        $body.="<head>";
        $body .= "<meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"UTF-8\">";
        $body.="<title></title>";
        $body.="</head>";
        $body.="<body>";
        $body.="Hi ".$this->entry['create_by'].",";
        $body.="<br><br>I'm here to remine you about the meeting you already booked. ";
        $body.="Click <a href='192.168.122.26/mrbs_sourcecode/view_entry.php?id=".$this->entry['id']."'>here</a> for more details<br><br>";
        $body .="The meeting already took ".Configuration::getConfiguration()->getTimeSendingMail()." minutes but nobody was there<br><br>";
        $body .="If you want to keep this meeting or cancel it, Let me know<br><br>";
        $body .="<form action=\"http://192.168.122.26/mrbs_sourcecode/API/ConfirmMailController.php\" method='POST'>
                  <input type=\"submit\" style=\"color:green\" value=\"Still keep\" name='btnKeep' class='stillkeep'>
                  <input type=\"submit\" style=\"color:red\" value=\"Cancel Meeting Room\" name='btnDelete' class='cancelmettingroom'>
                  <input type='hidden' name='room_id' value=".$this->entry['room_id'].">
                  <input type='hidden' name='id_entry' value=".$this->entry['id'].">
                </form> ";
        $body .="<br>If you do not take any action or nobody in this room in next 5 minutes, I will cancel the meeting<br><br>";
        $body.="Have nice day,<br>";
        $body.="Mr.Bot.<br>";
        $body.="</body><br>";
        $body.="</html>";
        return $body;
    }
}