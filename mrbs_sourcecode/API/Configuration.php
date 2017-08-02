<?php


class Configuration
{
    //config database
    private $db_host ;
    private $db_login ;
    private $db_password ;
    private $db_database ;
    private $ip_server ;

    //table name in database
    private $tbl_entry ;
    private $tbl_room ;
    private $tbl_users ;
    private $tbl_status ;

    //minimun time of meeting
    private $resolution ;
    private $max_break_time;
    //to write log set log_file_info to 1
    private $log_file_info ;

    //time to send mail remind
    private $time_sending_mail;

    //limit time can go late;
    private $limte_time_late;

    private static $configuration = null;

    private function __construct()
    {
        //these value must be the same with info in config.inc file
        $this->db_host = "localhost";
        $this->db_login = "root";
        $this->db_password = "intern9";
        $this->db_database = "mrbs";
        $this->ip_server = "192.168.122.26";

        //table name in database
        $this->tbl_entry = "mrbs_entry";
        $this->tbl_room = "mrbs_room";
        $this->tbl_users = "mrbs_users";
        $this->tbl_status = "mrbs_api_sensor_status";

        //minimun time of meeting
        $this->resolution = (15 * 60);
        $this->max_break_time = 10 * 60; // 10 minutes

        //to write log set log_file_info to 1
        $this->log_file_info = 1;

        $this->time_sending_mail = 2; //minutes

        $this->limte_time_late = 7;//minutes
    }

    /**
     * @return int
     */
    public function getMaxBreakTime()
    {
        return $this->max_break_time;
    }

    public static function getConfiguration()
    {
        if(Configuration::$configuration == null){
            Configuration::$configuration = new Configuration();
        }
        return Configuration::$configuration;
    }

    /**
     * @return string
     */
    public function getDbHost()
    {
        return $this->db_host;
    }

    /**
     * @return int
     */
    public function getTimeSendingMail()
    {
        return $this->time_sending_mail;
    }

    /**
     * @param int $time_sending_mail
     */
    public function setTimeSendingMail($time_sending_mail)
    {
        $this->time_sending_mail = $time_sending_mail;
    }

    /**
     * @return int
     */
    public function getLimteTimeLate()
    {
        return $this->limte_time_late;
    }

    /**
     * @param int $limte_time_late
     */
    public function setLimteTimeLate($limte_time_late)
    {
        $this->limte_time_late = $limte_time_late;
    }





    /**
     * @return string
     */
    public function getDbLogin()
    {
        return $this->db_login;
    }

    /**
     * @return string
     */
    public function getDbPassword()
    {
        return $this->db_password;
    }

    /**
     * @return string
     */
    public function getDbDatabase()
    {
        return $this->db_database;
    }

    /**
     * @return string
     */
    public function getIpServer()
    {
        return $this->ip_server;
    }

    /**
     * @return string
     */
    public function getTblEntry()
    {
        return $this->tbl_entry;
    }

    /**
     * @return string
     */
    public function getTblRoom()
    {
        return $this->tbl_room;
    }

    /**
     * @return string
     */
    public function getTblUsers()
    {
        return $this->tbl_users;
    }

    /**
     * @return string
     */
    public function getTblStatus()
    {
        return $this->tbl_status;
    }

    /**
     * @return int
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * @return int
     */
    public function getLogFileInfo()
    {
        return $this->log_file_info;
    }
}