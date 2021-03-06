<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Email Settings
| -------------------------------------------------------------------
| Configuration of outgoing mail server.
| */

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.goskn.com';
$config['smtp_port'] = '587';
$config['smtp_timeout'] = '30';
$config['smtp_user'] = 'username';
$config['smtp_pass'] = 'password';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";

// custom values from CI Bootstrap
$config['from_email'] = "noreply@goskn.com";
$config['from_name'] = "ST.Kitts && Nevis";
$config['subject_prefix'] = "[St.Kitts] ";

// Mailgun API (to be used in Email Client library)
$config['mailgun'] = array(
	'domain'				=> '',
	'private_api_key'		=> '',
);