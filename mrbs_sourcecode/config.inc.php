<?php
namespace MRBS;

// $Id$

/**************************************************************************
 *   MRBS Configuration File
 *   Configure this file for your site.
 *   You shouldn't have to modify anything outside this file.
 *
 *   This file has already been populated with the minimum set of configuration
 *   variables that you will need to change to get your system up and running.
 *   If you want to change any of the other settings in systemdefaults.inc.php
 *   or areadefaults.inc.php, then copy the relevant lines into this file
 *   and edit them here.   This file will override the default settings and
 *   when you upgrade to a new version of MRBS the config file is preserved.
 **************************************************************************/

/**********
 * Timezone
 **********/

// The timezone your meeting rooms run in. It is especially important
// to set this if you're using PHP 5 on Linux. In this configuration
// if you don't, meetings in a different DST than you are currently
// in are offset by the DST offset incorrectly.
//
// Note that timezones can be set on a per-area basis, so strictly speaking this
// setting should be in areadefaults.inc.php, but as it is so important to set
// the right timezone it is included here.
//
// When upgrading an existing installation, this should be set to the
// timezone the web server runs in.  See the INSTALL document for more information.
//
// A list of valid timezones can be found at http://php.net/manual/timezones.php
// The following line must be uncommented by removing the '//' at the beginning
$timezone = "Asia/Ho_Chi_Minh";


/*******************
 * Database settings
 ******************/
// Which database system: "pgsql"=PostgreSQL, "mysql"=MySQL
$dbsys = "mysql";
// Hostname of database server. For pgsql, can use "" instead of localhost
// to use Unix Domain Sockets instead of TCP/IP. For mysql "localhost"
// tells the system to use Unix Domain Sockets, and $db_port will be ignored;
// if you want to force TCP connection you can use "127.0.0.1".
$db_host = "localhost";
// If you need to use a non standard port for the database connection you
// can uncomment the following line and specify the port number
// $db_port = 1234;
// Database name:
$db_database = "mrbs";
// Schema name.  This only applies to PostgreSQL and is only necessary if you have more
// than one schema in your database and also you are using the same MRBS table names in
// multiple schemas.
//$db_schema = "public";
// Database login user name:
$db_login = "root";
// Database login password:
$db_password = 'intern9';
// Prefix for table names.  This will allow multiple installations where only
// one database is available
$db_tbl_prefix = "mrbs_";
// Set $db_persist to TRUE to use PHP persistent (pooled) database connections.  Note
// that persistent connections are not recommended unless your system suffers significant
// performance problems without them.   They can cause problems with transactions and
// locks (see http://php.net/manual/en/features.persistent-connections.php) and although
// MRBS tries to avoid those problems, it is generally better not to use persistent
// connections if you can.
$db_persist = TRUE;


/* Add lines from systemdefaults.inc.php and areadefaults.inc.php below here
   to change the default configuration. Do _NOT_ modify systemdefaults.inc.php
   or areadefaults.inc.php.  */

/*********************************
 * Site identification information
 *********************************/
$mrbs_admin = "Dek Administrator";
$mrbs_admin_email = "dekvnintern09@gmail.com";
// NOTE:  there are more email addresses in $mail_settings below.    You can also give
// email addresses in the format 'Full Name <address>', for example:
// $mrbs_admin_email = 'Booking System <admin_email@your.org>';
// if the name section has any "peculiar" characters in it, you will need
// to put the name in double quotes, e.g.:
// $mrbs_admin_email = '"Bloggs, Joe" <admin_email@your.org>';

// The company name is mandatory.   It is used in the header and also for email notifications.
// The company logo, additional information and URL are all optional.

$mrbs_company = "DEK Technologies";   // This line must always be uncommented ($mrbs_company is used in various places)

// Uncomment this next line to use a logo instead of text for your organisation in the header
$mrbs_company_logo = "images/dek-logo-png.png";    // name of your logo file.   This example assumes it is in the MRBS directory

// Uncomment this next line for supplementary information after your company name or logo
$mrbs_company_more_info = "Vietnam (All dates/times are in Ho Chi Minh City Time)";  // e.g. "XYZ Department"

// Uncomment this next line to have a link to your organisation in the header
$mrbs_company_url = "index.php";

// This is to fix URL problems when using a proxy in the environment.
// If links inside MRBS appear broken, then specify here the URL of
// your MRBS root directory, as seen by the users. For example:
// $url_base =  "http://webtools.uab.ericsson.se/oam";
// It is also recommended that you set this if you intend to use email
// notifications, to ensure that the correct URL is displayed in the
// notification.
$url_base = "";


/**********************************************
 * Email settings
 **********************************************/
// WHO TO EMAIL
// ------------
$mail_settings['booker'] = FALSE; // the person making the booking

// WHEN TO EMAIL
// -------------

$mail_settings['on_change'] = FALSE; // when an entry is changed
$mail_settings['on_delete'] = FALSE; // when an entry is deleted

// WHAT TO EMAIL
// -------------

$mail_settings['details'] = TRUE; // Set to TRUE if you want full booking details;
// otherwise you just get a link to the entry
$mail_settings['html'] = FALSE; // Set to true if you want HTML mail
$mail_settings['icalendar'] = FALSE; // Set to TRUE to include iCalendar details
// which can be imported into a calendar. (Note:
// iCalendar details will not be sent for areas
// that use periods as there isn't a mapping between
// periods and time of day, so the calendar would not
// be able to import the booking)

// HOW TO EMAIL - BACKEND
// ----------------------

$mail_settings['admin_backend'] = 'smtp';

/*******************
 * SMTP settings
 */

// These settings are only used with the "smtp" backend
$smtp_settings['host'] = 'smtp.gmail.com'; // SMTP server
$smtp_settings['port'] = 465; // SMTP port number
$smtp_settings['auth'] = TRUE; // Whether to use SMTP authentication
$smtp_settings['secure'] = 'ssl'; // Encryption method: '', 'tls' or 'ssl'
$smtp_settings['username'] = 'dekvnintern09@gmail.com'; // Username (if using authentication)
$smtp_settings['password'] = 'dekvnintern'; // Password (if using authentication)
$smtp_settings['disable_opportunistic_tls'] = false; // Set this to true to disable
// opportunistic TLS
// https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting#opportunistic-tls

// EMAIL - MISCELLANEOUS
// ---------------------

// Set the email address of the From field. Default is 'admin_email@your.org'
$mail_settings['from'] = 'dekvnintern09@gmail.com';


// Set the recipient email. Default is 'admin_email@your.org'. You can define
$enable_periods = TRUE; 
$resolution = (15 * 60);



/***********************************************
 * Authentication settings - read AUTHENTICATION
 ***********************************************/

$auth["session"] = "php"; // How to get and keep the user ID. One of
                          // "http", "php", "cookie", "ip", "host", "nt", "omni",
                          // "remote_user", "joomla" or "wordpress".

$auth["type"] = "ldap"; // How to validate the user/password. One of "none",
                      // "config", "db", "db_ext", "pop3", "imap", "ldap", "nis",
                      // "nw", "ext", "joomla" or "wordpress".


// 'auth_ldap' configuration settings

// Many of the LDAP parameters can be specified as arrays, in order to
// specify multiple LDAP directories to search within. Each item below
// will specify whether the item can be specified as an array. If any
// parameter is specified as an array, then EVERY array configuration
// parameter must have the same number of elements. You can specify a
// parameter as an array as in the following example:
//
// $ldap_host = array('localhost', 'otherhost.example.com');

// Where is the LDAP server.
// This can be an array.
$ldap_host = "192.168.122.26";

// If you have a non-standard LDAP port, you can define it here.
// This can be an array.
$ldap_port = 389;

// If you do not want to use LDAP v3, change the following to false.
// This can be an array.
$ldap_v3 = true;

// If you want to use TLS, change the following to true.
// This can be an array.
$ldap_tls = false;

// LDAP base distinguish name.
// This can be an array.
$ldap_base_dn = "ou=DEKTech,dc=192,dc=168,dc=122,dc=26";

// Attribute within the base dn that contains the username
// This can be an array.
$ldap_user_attrib = "cn";

// If you need to search the directory to find the user's DN to bind
// with, set the following to the attribute that holds the user's
// "username". In Microsoft AD directories this is "sAMAccountName"
// This can be an array.
$ldap_dn_search_attrib = "cn";

// If you need to bind as a particular user to do the search described
// above, specify the DN and password in the variables below
// These two parameters can be arrays.
// $ldap_dn_search_dn = "cn=Search User,ou=Users,dc=example,dc=com";
// $ldap_dn_search_password = "some-password";

// 'auth_ldap' extra configuration for ldap configuration of who can use
// the system
// If it's set, the $ldap_filter will be used to determine whether a
// user will be granted access to MRBS
// This can be an array.
// An example for Microsoft AD:
$ldap_filter = ["memberof=cn=User,ou=DEKTech,dc=192,dc=168,dc=122,dc=26","memberof=cn=Admin,ou=DEKTech,dc=192,dc=168,dc=122,dc=26"];

// If you need to filter a user by the group a user is in with an LDAP
// directory which stores group membership in the group object
// (like OpenLDAP) then you need to search for the groups they are
// in. If you want to do this, define the following two variables, an
// an appropriate $ldap_filter. e.g.:
// $ldap_filter_base_dn = "ou=Groups,dc=example,dc=com";
$ldap_filter_user_attr = "memberuid";
// $ldap_filter = "cn=MRBS Users";

// If you need to disable client referrals, this should be set to TRUE.
// Note: Active Directory for Windows 2003 forward requires this.
// $ldap_disable_referrals = TRUE;

// LDAP option for dereferencing aliases
// LDAP_DEREF_NEVER = 0 - (default) aliases are never dereferenced.
// LDAP_DEREF_SEARCHING = 1 - aliases should be dereferenced during the search
//      but not when locating the base object of the search.
// LDAP_DEREF_FINDING = 2 - aliases should be dereferenced when locating the base object but not during the search.
// LDAP_DEREF_ALWAYS = 3 - aliases should be dereferenced always.
//$ldap_deref = LDAP_DEREF_ALWAYS;

// Set to TRUE to tell MRBS to look up a user's email address in LDAP.
// Utilises $ldap_email_attrib below
$ldap_get_user_email = TRUE;
// The LDAP attribute which holds a user's email address
// This can be an array.
$ldap_email_attrib = 'mail';

// The DN of the LDAP group that MRBS admins must be in. If this is defined
// then the $auth["admin"] is not used.
// This can be an array.
 $ldap_admin_group_dn = 'cn=Admin,ou=DEKTech,dc=192,dc=168,dc=122,dc=26';

// The LDAP attribute that holds group membership details. Used with
// $ldap_admin_group_dn, above.
// This can be an array.
$ldap_group_member_attrib = 'memberof';

// Set to TRUE if you want MRBS to call ldap_unbind() between successive
// attempts to bind. Unbinding while still connected upsets some
// LDAP servers
$ldap_unbind_between_attempts = FALSE;

// Output debugging information for LDAP actions
$ldap_debug = TRUE;
