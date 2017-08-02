<?php
include "ConfirmEmailBody.php";
include "EditEmailBody.php";

class FactoryEmailBody
{
    static function get_email_body($type, $entry)
    {
        switch ($type)
        {
            case "confirm":
                return new ConfirmEmailBody($entry);
            case "edit":
                return new EditEmailBody();
        }
    }
}