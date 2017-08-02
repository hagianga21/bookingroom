<?php

include_once "Query.php";
include_once "EntryGetting.php";
include_once "StatusGetting.php";
include_once "StatusUpdating.php";
include_once "StatusInserting.php";
include_once "StatusDeleting.php";
include_once "class.phpmailer.php";
include_once "class.smtp.php";
include_once "UsersGetting.php";
include_once "EntryUpdating.php";
include_once "/home/deklab/titan/mrbshack/mrbs_sourcecode/auth/auth_ldap.inc";
include_once  "Configuration.php";

define("SCORE_HIGHEST",25);// 1 1
define("SCORE_HIGH",20);// 0 1
define("SCORE_LOW",15);//  1 0
define("SCORE_LOWEST",10);// 0 0
define("SOCRE_MAX",700);
define("SCORE_MIN",280);
define("SCORE_LIMIT_NOBODY",((SOCRE_MAX-SCORE_MIN)*0.2)+SCORE_MIN);
define("NOBODY",0);
define("SOMEONE",1);
define("API_KEY","T7ya9Ud09zLuC3ieFp5GD");
define("TEN_MINUTES",60*10);
define("ONE_MINUTE", 60);
define("A_HALF_OF_RESOLUTION", 8);
define("ROOM_ID", "room_id");




class Handler
{
    private $room_id = null;
    private $status = null;
    private $entry = null;
    public static $is_waiting = true;
    public static $count_status_history = 0;
    private $query = null;

    function __construct($room_id = null, $staus_from_sensor_of_room = null)
    {
        //echo "constructor";
        $this->room_id = $room_id;
        $this->status = $staus_from_sensor_of_room;
        $this->query = new Query();

    }
    function  __destruct()
    {
        unset($this->room_id);
        unset($this->status);
    }

    /**
     * @return bool
     */
    public function is_someone_in_room()
    {
        if($this->handle_status() == SOMEONE)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function is_in_break_time()
    {
        $this->query->setGetting(new StatusGetting());
        $result = $this->query->select( "". ROOM_ID." = $this->room_id", "is_break_time");
        if($result['is_break_time'] == 1){
            if($this->is_break_time_end()){
                $this->query->setUpdating(new StatusUpdating());
                $this->query->update(array("is_break_time"=>0), "room_id = $this->room_id");
                return false;
            }
            return true;

        }
        return false;
    }

    function is_break_time_end()
    {
        $current_time = strtotime(date("Y-m-d H:i:s"));
        $this->query->setGetting(new StatusGetting());
        $result = $this->query->select("room_id = $this->room_id", "end_break_time");
        if($current_time >= $result['end_break_time'])
        {
            return true;
        }
        return false;
    }

    function set_is_waiting(){
        $this->query->setGetting(new StatusGetting());
        $result = $this->query->select("room_id = $this->room_id", "is_waiting");
        if($result['is_waiting'] == 0){
            Handler::$is_waiting = false;
        }
        else
        {
            Handler::$is_waiting = true;
        }
    }


    function get_room_id()
    {
        if(!$this->room_id)
        {
            throw  new \Exception("Room_id is empty");
        }
        return $this->room_id;
    }

    function set_room_id($room_id)
    {
        if($room_id <= 0)
        {
            throw  new \Exception("Set room_id fail");
        }
        $this->room_id = $room_id;
    }

    /**
     * @return null
     */
    public function getEntry()
    {
        return $this->entry;
    }



    function get_staus_from_sensor_of_room()
    {
        if(!$this->status)
        {
            throw new \Exception( "status is null");
        }
        return $this->status;
    }


    function set_staus_from_sensor_of_room($staus_from_sensor_of_room)
    {
        if($staus_from_sensor_of_room < 0)
        {
            throw new \Exception( "status should more than 0");

        }
        $this->status = $staus_from_sensor_of_room;
    }



    function is_this_room_booking_at_this_time($room_id)
    {
        $this->query->setGetting(new EntryGetting());
        $interval_time = $this->get_start_time_and_end_time_by_current_time();
        $condition = " room_id = '".$room_id."' AND start_time <= '".$interval_time['start_time']. "' AND end_time >= '".$interval_time['end_time']."'";
        $entry = $this->query->select($condition);
        $current_time = strtotime(date("Y-m-d H:i:s"));
        if(!empty($entry) && $current_time >= $entry['start_time'] && $current_time <= $entry['end_time'])
        {
            $this->entry = $entry;
            return true;
        }
        else
            return false;
    }

    function get_start_time_and_end_time_by_current_time()
    {
        $resolution = Configuration::getConfiguration()->getResolution();
        $resolution_minute = $resolution / ONE_MINUTE;
        $part = ONE_MINUTE / $resolution_minute;
        (int) $minute_now = date("i");

        for($current_part = 1; $current_part <= $part; $current_part++)
        {
            if($current_part == $part)
            {
                $hour = date("H");
                (int)$hour++;

                $start_minute = $resolution_minute * ($current_part - 1);
                $start_time_format = "Y-m-d H:$start_minute";

                $end_time_format = "Y-m-d $hour:00";

                return $array_time_result = array("start_time"=>strtotime(date($start_time_format)),
                    "end_time"=>strtotime(date($end_time_format)));
            }

            if($minute_now < $resolution_minute * $current_part)
            {
                $start_minute = $resolution_minute * ($current_part - 1);
                $start_time_format = "Y-m-d H:$start_minute";

                $end_minute = $resolution_minute * $current_part;
                $end_time_format = "Y-m-d H:$end_minute";

                return $array_time_result = array("start_time"=>strtotime(date($start_time_format)),
                    "end_time"=>strtotime(date($end_time_format)));
            }
        }


    }
    function is_not_meeting_time_nearly_finished()
    {
        $resolution = Configuration::getConfiguration()->getResolution();

        $current_time = strtotime(date("Y-m-d H:i:s"));
        $end_time = $this->entry['end_time'];
        $rest_time = $end_time - $current_time;
        $a_part_of_minute_resolutions = ($resolution / 2);
        if($rest_time > $a_part_of_minute_resolutions)
            return true;
        else
            return false;
    }

    function is_the_room_start_up_to_eight_minutes()
    {

        $this->query->setGetting(new StatusGetting());
        $result = $this->query->select("room_id = $this->room_id","count_status_history");
        Handler::$count_status_history = $result['count_status_history'];

        if(Handler::$count_status_history >= A_HALF_OF_RESOLUTION)
        {
            return true;
        }

        return false;
    }

    function is_the_room_start_up_8_minutes_from_current_time(){
        $current_time = strtotime(date("Y-m-d H:i:s"));
        $start_time_check = $this->entry['start_time'];
        $time = $current_time - $start_time_check;
        if($time >= 480){
            return true;
        }
        return false;
    }

    function get_email_booker($name_booker)
    {
        $this->query->setGetting(new UsersGetting());
        $result = $this->query->select("name = '".$name_booker."'", "email");
        $email_booker = $result["email"];
        if (!empty($email_booker))
            return $email_booker;
        else
            throw new \Exception("Name booker is not exist");
    }


    function set_up_parameter_and_send_mail($body)
    {
        $nFrom = "DEK Technologies";    //mail duoc gui tu dau, thuong de ten cong ty ban
        $mFrom = 'dekvnintern09@gmail.com';  //dia chi email cua ban
        $mPass = 'dekvnintern';       //mat khau email cua ban
        $nTo = $this->entry["create_by"]; //Ten nguoi nhan
        $mTo = \MRBS\authGetUserEmail($nTo);//dia chi nhan mail
        $mail = new PHPMailer();
        $title = "Entry changed for DEK MRBS by ESP8266";   //Tieu de gui mail
        $mail->IsSMTP();
        $mail->CharSet  = "utf-8";
        $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;    // enable SMTP authentication
        $mail->SMTPSecure = "ssl";   // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";    // sever gui mail.
        $mail->Port       = 465;         // cong gui mail de nguyen
        // xong phan cau hinh bat dau phan gui mail
        $mail->Username   = $mFrom;  // khai bao dia chi email
        $mail->Password   = $mPass;              // khai bao mat khau
        $mail->SetFrom($mFrom, $nFrom);
        $mail->AddReplyTo($mFrom, $nFrom); //khi nguoi dung phan hoi se duoc gui den email nay
        $mail->Subject    = $title;// tieu de email
        $mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
        $mail->AddAddress($mTo, $nTo);
        // thuc thi lenh gui mail
        if(!$mail->Send()) {
            echo "Mail error: $mail->ErrorInfo";

        }
    }


    //$status (interger 0->255)
    function handle_status()
    {
        if($this->Heuricstic()<= SCORE_LIMIT_NOBODY)
        {
            if($this->maybe_some_one_in_room()==NOBODY)
            {
                if($this->nobody_in_room()==NOBODY)
                {
                    return NOBODY;
                }
            }

        }

        return SOMEONE;
    }

    function Heuricstic()
    {
        $str_status = str_split(sprintf("%08b",$this->status));
        $score = 0;
        for($bit = 0; $bit < 7; $bit++)
        {
            if($str_status[$bit]==1)
            {
                if($str_status[$bit + 1]==1)
                    $score += (SCORE_HIGHEST + ($bit * SCORE_HIGHEST));
                else
                    $score += (SCORE_LOW + ($bit * SCORE_LOW));
            }
            else
            {
                if($str_status[$bit + 1] == 1)
                    $score += (SCORE_HIGH + ($bit * SCORE_HIGH));
                else
                    $score += (SCORE_LOWEST + ($bit * SCORE_LOWEST));
            }
        }
        return $score;
    }

    function maybe_some_one_in_room()
    {
        $result = 0;
        for($bit = 0 ; $bit < 8 ; $bit++)
            $result += ($this->status >> $bit) & 1;
        return $result >= 4 ? SOMEONE : NOBODY;
    }

    function nobody_in_room()
    {
        $result = 0;
        for($bit = 0 ; $bit < 4 ; $bit++)
            $result += ($this->status >> $bit) & 1;
        return $result >= 2 ? SOMEONE : NOBODY;
    }

    function get_new_entry($end_time){
        $new_entry = $this->entry;
        if(!($new_entry["repeat_id"]===NULL))
            $new_entry["entry_type"] = 2;
        (int)$new_entry["ical_sequence"]++;
        $new_entry["end_time"] = $end_time;
        $new_entry["timestamp"] = date("Y-m-d H:i:s");
        $new_entry["modified_by"] = "ESP8266";
        return $new_entry;
    }

    function edit_entry($end_time)
    {
        $new_entry = $this->get_new_entry($end_time);
        $id_entry = $new_entry["id"];
        unset($new_entry["id"]);
        $this->query->setUpdating(new EntryUpdating());
        $result = $this->query->update($new_entry,"id = $id_entry");
        writeLogInfo("ESP8266", "Update Entry Table at entry_id $id_entry set end_time to ".date("Y-m-d H:i:s", $end_time)."");
        return $result;

    }

    function insert_status()
    {
        $this->query->setInserting(new StatusInserting());
        $data = array("status_history"=>$this->handle_status(),"count_status_history"=>"0","room_id"=>"$this->room_id");
        $result = $this->query->Insert($data);
        writeLogInfo("ESP8266","Insert INTO Status Table: status_history\"=>\"$this->handle_status()\",\"count_status_history\"=>\"0\",\"room_id\"=>\"$this->room_id");
        return $result;
    }

    function get_information_by_room_in_mrbs_status()
    {
        $this->query->setGetting(new StatusGetting());
        return $this->query->select("room_id = '".$this->get_room_id()."'");
    }

    function update_status()
    {
        $row = $this->get_information_by_room_in_mrbs_status();
        $new_status = $this->convert_status($row["status_history"]);
        $this->status = $new_status;
        $row["status_history"] = $new_status;
        $this->query->setUpdating(new StatusUpdating());
        $result = $this->query->update($row,"id = '".$row["id"]."'");
        writeLogInfo("ESP8266", "Update INTO status of sensor table: count_stattus_history++ AND status history into ".$row['id']."");
        return $result;
    }

    function update_count_status_history()
    {
        $row = $this->get_information_by_room_in_mrbs_status();
        (int)$row["count_status_history"]++;
        $this->query->setUpdating(new StatusUpdating());
        $result = $this->query->update($row,"id = '".$row["id"]."'");
        writeLogInfo("ESP8266", "Update INTO status of sensor table: count_stattus_history++ AND status history into ".$row['id']."");
        return $result;
    }

    function convert_status($old_status)
    {
        $old_status <<= 1;
        return ($old_status | $this->handle_status())& 255;//255 -> 11111111
    }

    function delete_history_status_by_room_id()
    {
        $this->query->setDeleting(new StatusDeleting());
        $result = $this->query->delete("room_id = $this->room_id");
        writeLogInfo("ESP8266", "Delete history status at room_id = $this->room_id");
        return $result;
    }

    function update_is_waiting($data)
    {
        $this->query->setUpdating(new StatusUpdating());
        $this->query->update($data, "room_id = '".$this->room_id."'");
        writeLogInfo("ESP8266","Update is waiting at room_id = '".$this->room_id."'");
    }

    function update_count_history_status(){

        $this->query->setUpdating(new StatusUpdating());
        $this->query->update(array("count_status_history"=>0), "room_id = $this->room_id");
    }

    function is_someone_in_room_through_two_minutes()
    {
        $result= $this->status & 3; //3 -> 11
        return $result > 0 ? SOMEONE : NOBODY;
    }


}


