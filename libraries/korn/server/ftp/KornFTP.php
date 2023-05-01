<?php

namespace libraries\korn\server\ftp;

use libraries\korn\server\connection\KornFTPConnection;
use libraries\korn\utils\KornPerformance;

class KornFTP {
	public static string $remoteBaseDir = '/domains/kornyellow.com/public_html';

	public static function reuploadProjectToProduction(): void {
		self::removeAllFilesFromRemote();
		echo "\n";
		self::updateProjectToProduction();
	}

	public static function removeAllFilesFromRemote(): void {
		echo "\n\033[32m".'Start removing all files from '.self::$remoteBaseDir.' please wait...'."\n";
		KornPerformance::startMeasureLoadTime();
		self::removeAllFilesFromRemoteDir(self::$remoteBaseDir);
		KornPerformance::stopMeasureLoadTime();
		echo "\033[33m".'All files removed from '.self::$remoteBaseDir.', taking '.KornPerformance::getMeasuredLoadTime().' seconds'."\n";
	}

	private static function removeAllFilesFromRemoteDir(string $remotePath): void {
		$files = ftp_nlist(KornFTPConnection::getFTP(), $remotePath);
		if (is_array($files)) {
			foreach ($files as $file) {
				if (basename($file) === '.' || basename($file) === '..') {
					continue;
				}

				if (ftp_size(KornFTPConnection::getFTP(), $file) === -1) {
					self::removeAllFilesFromRemoteDir($file);
				} else {
					ftp_delete(KornFTPConnection::getFTP(), $file);
					echo "\033[31m".'File '.basename($file).' has been removed from '.$file."\n";
				}
			}
			if (self::$remoteBaseDir != $remotePath)
				if (ftp_rmdir(KornFTPConnection::getFTP(), $remotePath))
					echo "\033[31m".'Directory '.$remotePath.' has been removed'."\n";
		}
	}

	public static function updateProjectToProduction(): void {
		$localBaseDir = getcwd();

		$excludeList = [
			'.git',
			'.gitignore',
			'.idea',
			'composer.json',
			'composer.lock',
			'composer.phar',
			'gruvbox.png',
			'README.md',
			'update.php',
			'reupload.php',
		];

		echo "\n\033[32m".'Start updating project please wait...'."\n";
		KornPerformance::startMeasureLoadTime();
		self::uploadFilesAndDirectories($localBaseDir, self::$remoteBaseDir, $excludeList);
		KornPerformance::stopMeasureLoadTime();
		echo "\033[33m".'Update project completed, taking '.KornPerformance::getMeasuredLoadTime().' seconds'."\n";
	}

	private static function uploadFilesAndDirectories(string $localPath, string $remotePath, array $excludeList = []): void {
		if (!@ftp_chdir(KornFTPConnection::getFTP(), $remotePath)) {
			ftp_mkdir(KornFTPConnection::getFTP(), $remotePath);
			echo "\033[38;5;208m".'Directory '.basename($localPath).' has been created at '.$remotePath."\n";
			ftp_chdir(KornFTPConnection::getFTP(), $remotePath);
		}

		$files = array_diff(scandir($localPath), ['.', '..']);
		foreach ($files as $file) {
			$localFile = "$localPath/$file";
			$remoteFile = "$remotePath/$file";

			if (in_array($file, $excludeList))
				continue;

			if (is_dir($localFile)) {
				self::uploadFilesAndDirectories($localFile, $remoteFile, $excludeList);
			} else {
				$remoteModifyTime = ftp_mdtm(KornFTPConnection::getFTP(), $remoteFile);
				$localModifyTime = filemtime($localFile);

				if ($remoteModifyTime !== -1 && $remoteModifyTime >= $localModifyTime)
					continue;

				ftp_put(KornFTPConnection::getFTP(), $remoteFile, $localFile);
				echo "\033[34m".'File '.basename($localFile).' has been uploaded at '.$remoteFile."\n";
			}
		}
	}
}