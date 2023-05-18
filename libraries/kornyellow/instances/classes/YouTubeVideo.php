<?php

namespace libraries\kornyellow\instances\classes;

class YouTubeVideo {
	public function __construct(
		private readonly string $id,
		private readonly string $title,
		private readonly string $description,
		private readonly string $thumbnail,
	) {}

	public function getID(): string {
		return $this->id;
	}
	public function getTitle(): string {
		return $this->title;
	}
	public function getDescription(): string {
		return $this->description;
	}
	public function getThumbnail(): string {
		return $this->thumbnail;
	}

	public function getThumbnailImage(int $width = 1920, int $height = 1080): string {
		return "
			<div class='yt-thumbnail'>
				<img class='img-fluid' alt='$this->title' src='$this->thumbnail' width='$width' height='$height'>
			</div>
		";
	}
	public function getFrame(): string {
		return "
			<div class='iframe-responive'>
				<iframe src='https://www.youtube.com/embed/$this->id' allow='autoplay; encrypted-media' allowfullscreen></iframe>
			</div>
		";
	}
}