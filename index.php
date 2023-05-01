<?php

declare(strict_types=1);

use libraries\korn\client\KornHeader;
use libraries\korn\KornConfig;
use libraries\korn\server\connection\KornDatabaseConnection;
use libraries\korn\server\connection\KornFTPConnection;
use libraries\korn\utils\KornNetwork;
use libraries\korn\utils\KornPerformance;

// Make errors visible
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_PARSE | E_ERROR);

// Set timezone
date_default_timezone_set('Asia/Bangkok');

// Libraries for autoload classes
include('vendor/autoload.php');

// Config header
KornConfig::$websiteName = 'KORNYELLOW';
KornConfig::$websiteAuthor = 'กร โรจน์รัตนปัญญา (กร)';
KornConfig::$websiteOwner = 'kornkubzaza@gmail.com';
KornConfig::$defaultTitle = 'KORNYELLOW';
KornConfig::$defaultDescription = 'ผม กร โรจน์รัตนปัญญา ยินดีต้อนรับเข้าสู่เว็บไซต์ของผม สนใจร่วมงานกับผมทำเว็บ ทำเกม เขียนโปรแกรมหลายภาษา และอีกมายมาย ติดต่อเข้ามาเลย';
KornConfig::$defaultAbstract = 'หน้าแรกของเว็บไซต์ เกริ่นถึงตัวเอง งานที่รับทำ และอื่น ๆ';
KornConfig::$defaultKeywords = 'สร้างเกม, ทำเกม, gamemaker, เขียนเกม, ตัดต่อเพลง, เขียนเว็บไซต์, พัฒนาเว็บไซต์, เขียนโปรแกรม, เขียนโค้ด, html, css, javascript, php, mysql, nodejs, mongodb, korn rojrattanapanya, kornyellow, korn, กร โรจน์รัตนปัญญา';

// Start Sessions
session_start();

// Find requested path
$requestPath = KornNetwork::getRequestPath();
$absolutePath = KornNetwork::getAbsolutePath($requestPath);
if ($requestPath != $absolutePath) {
	KornNetwork::redirectPage('/'.$absolutePath);
}

// Preventing user from accessing direct install.php
if (str_ends_with($absolutePath, 'index.php')) {
	$absolutePath = substr($absolutePath, 0, -9);
	KornNetwork::redirectPage('/'.$absolutePath);
}

// Remove Get Request
$absolutePath = strstr($absolutePath, "?", true) ?: $absolutePath;

// Apply Canonical URL
KornHeader::setCanonical($absolutePath);

// Find a requested file
$requestFile = KornNetwork::getDocumentRoot().'/contents/';

if (empty($absolutePath)) {
	$requestFile .= 'index.php';
} else if (!file_exists($requestFile.$absolutePath.'.php')) {
	$requestFile .= $absolutePath.'/index.php';
} else {
	$requestFile .= $absolutePath.'.php';
}

// Start measuring page load time
KornPerformance::startMeasureLoadTime();

// Construct an entire page
if (file_exists($requestFile)) {
	include($requestFile);
} else {
	http_response_code(404);
	include('controller/errors/404.php');
}

// Stop measuring page load time
KornPerformance::stopMeasureLoadTime();

include('controller/footer.php');

// Close all Connection
KornDatabaseConnection::closeConnection();
KornFTPConnection::closeConnection();