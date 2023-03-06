<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/* Custom constant for table and field name*/


define('SESSION_USER','hc_storage_auth');
define('SESSION_USER_ID','hc_storage_id');
define('SESSION_USER_EMAIL','hc_user_email');
define('SESSION_USER_FULLNAME','hc_storage_fullname');
define('SESSION_USER_ROLE','hc_storage_role');
define('SESSION_USER_ROLE_NAME','hc_storage_role_name');
define('SESSION_USER_PROFILE_PICTURE','hc_storage_foto');

//table user
define('TABLE_USER','hc_user');
define('F_USER_ID','id_user');
define('F_USER_FULLNAME','user_fullname');
define('F_USER_EMAIL', 'email');
define('F_USER_PASSWORD','password');
define('F_USER_TYPE','id_user_type');
define('F_USER_EMPLOYE','no_employe');
define('F_USER_COMPANY', 'id_company');
define('F_USER_UNIT', 'id_unit');
define('F_USER_DEPARTMENT','id_department');
define('F_USER_IMAGE','image');
define('F_USER_STATUS','status');

/*define untuk table user type*/
define('TABLE_USER_TYPE','hc_user_type');
define('F_USER_TYPE_ID','id_user_type');
define('F_USER_TYPE_NAME','type_name');

/*define untuk table navigation*/
define('TABLE_NAVIGATION','hc_navigation');
define('F_NAVIGATION_ID','id_navigation');
define('F_NAVIGATION_NAME','navigation_name');
define('F_NAVIGATION_LINK','link');
define('F_NAVIGATION_ICON','icon');
define('F_NAVIGATION_PARENT','parent');
define('F_NAVIGATION_ORDER','order_position');

/*define untuk table navigation permission*/
define('TABLE_NAV_PERMISSION','hc_navigation_permission');
define('F_NAV_PERMISSION_ID','id_permission');
define('F_NAV_PERMISSION_NAVIGATION','id_navigation');
define('F_NAV_PERMISSION_ROLE','id_user_type');

/*define untuk table user permission*/
define('TABLE_USER_PERMISSION','hc_user_permission');
define('F_UP_ID','up_id');
define('F_UP_USER','id_user');
define('F_UP_NAME','navigation_name');
define('F_UP_LINK','navigation_link');
define('F_UP_PERMISSION','permission');

/*define untuk table page*/
define('TABLE_PAGE','hc_page');
define('F_PAGE_ID','id_page');
define('F_PAGE_NAME','page_name');
define('F_PAGE_URL','page_url');

/*define untuk table page permission*/
define('TABLE_PAGE_PERMISSION','hc_page_permission');
define('F_PAGE_PERMISSION_ID','id_permission');
define('F_PAGE_PERMISSION_PAGE','id_page');
define('F_PAGE_PERMISSION_ROLE','id_role');

define('TABLE_USER_NAVIGATION','hc_user_navigation');
define('F_USER_NAV_ID','id_permission');
define('F_USER_NAV_NAVIGATION','id_navigation');
define('F_USER_NAV_USER','id_user');


define('UNDELETED','deleted IS NULL');
define('DELETED','deleted IS NOT NULL');
define('BLANK_PROFILE_PICTURE','blank_pic.png');
define('VALUE_NOT_EXIST','not_exist');