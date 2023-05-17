<?php

namespace kornyellow;

use KornyellowLib\Server\Ftp\KornFTP;

include("vendor/autoload.php");

$_SERVER["DOCUMENT_ROOT"] = getcwd();
KornFTP::updateProjectToProduction();