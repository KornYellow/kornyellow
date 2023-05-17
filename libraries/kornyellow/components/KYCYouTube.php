<?php

namespace libraries\kornyellow\components;

use libraries\korn\utils\KornCredential;
use libraries\kornyellow\instances\classes\YouTubeVideo;

class KYCYouTube {
	/**
	 * @param int $count
	 *
	 * @return YouTubeVideo|YouTubeVideo[]
	 */
	public static function getYoutubeVideo(int $count = 1): YouTubeVideo|array {
		$apiKey = KornCredential::getAPIKeyYoutube();
		$channelID = "UCSgUwlFlKYQXEh5BIs1OsKQ";

		$apiURL = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=$channelID&maxResults=$count&order=date&type=video&key=$apiKey";

		$response = file_get_contents($apiURL);
		$json = json_decode($response);

		$result = [];
		for ($i = 0; $i < $count; $i++) {
			$result[] = new YouTubeVideo(
				$json->items[$i]->id->videoId,
				$json->items[$i]->snippet->title,
				$json->items[$i]->snippet->description,
				$json->items[$i]->snippet->thumbnails->high->url,
			);
			if ($count == 1)
				return $result[0];
		}

		return $result;
	}
}