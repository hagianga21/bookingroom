<?php

include_once "EmailBody.php";
include_once "Configuration.php";
class EditEmailBody extends EmailBody
{

    private $old_entry;
    private $new_entry;

    /**
     * EditEmailBody constructor.
     * @param $old_entry
     * @param $new_entry
     */
    public function __construct($old_entry, $new_entry)
    {
        $this->old_entry = $old_entry;
        $this->new_entry = $new_entry;
    }


    function create_body()
    {
        $body ="";
        $body.="<!DOCTYPE HTML>";
        $body.="<html>";
        $body.="<head>";
        $body .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . "utf-8" . "\">";
        $body.="<title></title>";
        $body.="</head>";
        $body.="<body>";
        $body.="Hi ".$this->new_entry['create_by'].",";
        $body.="<br><br>I'm here to inform you that your meeting was modified because you don't use the room for long time.<br>";
        $ip_server = Configuration::getConfiguration()->getIpServer();

        //mrbs_sourcecode/
        $body.="<a href='".$ip_server."/mrbs_sourcecode/view_entry.php?id=".$this->old_entry['id']."'>Here</a> are the details:<br><br>";
        $body.="Brief descripstion: ".$this->new_entry["name"]."<br>";
        $body.="Description: ".$this->new_entry["description"]."<br>";
        $body.=(int)$this->new_entry["status"]== 0 ? "Confirmation status: Confirmed<br>":"Confirmation status: Tentative<br>";
        //get room name by room id

        $body.="Room: ".$this->get_room_name($this->new_entry["room_id"])."<br>";

        $start_time = date_create(date("Y-m-d H:i:s",$this->new_entry["start_time"]));
        $body.="Start time: ".date_format($start_time,"g:ia \o\\n l jS F Y")."<br>";

        //12h (5H)
        $old_duration = (int)$this->old_entry["end_time"] - $this->old_entry["start_time"];
        $old_duration = (float)$old_duration / (60*60);

        $new_duration = (int)$this->new_entry["end_time"] - $this->new_entry["start_time"];
        $new_duration = (float)$new_duration / (60*60);


        $body.="Duration: ".$new_duration."H  (".$old_duration."H)<br>";

        //old end time (new end time)8
        $old_endtime = date_create(date("Y-m-d H:i:s",$this->old_entry["end_time"]));
        $new_endtime = date_create(date("Y-m-d H:i:s",$this->new_entry["end_time"]));

        $body.="End time: ".date_format($new_endtime,"g:ia \o\\n l jS F Y")."\t(".date_format($old_endtime,"g:ia \o\\n l jS F Y").")<br>";
        $body.=$this->new_entry["type"]=="I"?"Type: Internal<br>":"Type: External<br>";
        $body.="Create by: ".$this->new_entry["create_by"]."<br>";
        // a (b)
        $old_endtime = date_create($this->old_entry["timestamp"]);
        $new_endtime = date_create($this->new_entry["timestamp"]);

        $body.="Last update: ".date_format($new_endtime,"g:ia \o\\n l jS F Y").
            "\t(".date_format($old_endtime,"g:ia \o\\n l jS F Y").")<br>";
        $body.="<br>Have nice day,<br>";
        $body.="Mr.Bot.";
        $body.="</body><br>";
        $body.="</html>";
        return $body;
    }
}
