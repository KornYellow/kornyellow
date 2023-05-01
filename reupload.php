<?php

use libraries\korn\server\ftp\KornFTP;

include('vendor/autoload.php');
$_SERVER['DOCUMENT_ROOT'] = getcwd();

KornFTP::reuploadProjectToProduction();