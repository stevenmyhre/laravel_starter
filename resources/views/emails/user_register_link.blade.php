<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css">
        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>
<h2>Welcome to Blockwatch alarm!</h2>

<p>We have your account setup and ready to go - you just need to select a username/password
    to login to the system and start setting up your notifications.</p>
<p>
    <a href="{{ Config::get('app.url') }}/auth/register?code={{ urlencode($code) }}">Click here</a> to choose your username.
</p>

Sincerely,
<br/>
Blockwatch Alarm


</body>
</html>