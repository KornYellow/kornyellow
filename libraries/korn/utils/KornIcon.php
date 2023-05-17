<?php

namespace libraries\korn\utils;

class KornIcon {
	public function __construct(
		private readonly string $iconName = "",
		private string|null     $size = null,
		private int             $marginLeft = 0,
		private int             $marginRight = 0,
		private bool            $isFullWidth = true,
		private string          $additionalClasses = "",
	) {}

	public function __toString(): string {
		return "
			<i class='
				fa-solid $this->additionalClasses 
				".($this->isFullWidth ? "fa-fw" : "")." fa-$this->iconName
				ms-$this->marginLeft me-$this->marginRight
				fa-".($this->size ?? "$this->size")."
			'>
			</i>
		";
	}
	public function getIconName(): string { return $this->iconName; }

	public function mx1(): self {
		$this->marginLeft = $this->marginRight = 1;

		return $this;
	}
	public function mx2(): self {
		$this->marginLeft = $this->marginRight = 2;

		return $this;
	}
	public function mx3(): self {
		$this->marginLeft = $this->marginRight = 3;

		return $this;
	}
	public function mx4(): self {
		$this->marginLeft = $this->marginRight = 4;

		return $this;
	}
	public function mx5(): self {
		$this->marginLeft = $this->marginRight = 5;

		return $this;
	}

	public function ms1(): self {
		$this->marginLeft = 1;

		return $this;
	}
	public function ms2(): self {
		$this->marginLeft = 2;

		return $this;
	}
	public function ms3(): self {
		$this->marginLeft = 3;

		return $this;
	}
	public function ms4(): self {
		$this->marginLeft = 4;

		return $this;
	}
	public function ms5(): self {
		$this->marginLeft = 5;

		return $this;
	}

	public function me1(): self {
		$this->marginRight = 1;

		return $this;
	}
	public function me2(): self {
		$this->marginRight = 2;

		return $this;
	}
	public function me3(): self {
		$this->marginRight = 3;

		return $this;
	}
	public function me4(): self {
		$this->marginRight = 4;

		return $this;
	}
	public function me5(): self {
		$this->marginRight = 5;

		return $this;
	}

	public function xxs(): self {
		$this->size = "xxs";

		return $this;
	}
	public function xs(): self {
		$this->size = "xs";

		return $this;
	}
	public function sm(): self {
		$this->size = "sm";

		return $this;
	}
	public function lg(): self {
		$this->size = "lg";

		return $this;
	}
	public function xl(): self {
		$this->size = "xl";

		return $this;
	}
	public function xxl(): self {
		$this->size = "xxl";

		return $this;
	}

	public function nofw(): self {
		$this->isFullWidth = false;

		return $this;
	}
	public function more(string $classes): self {
		$this->additionalClasses = $classes;

		return $this;
	}

	/**
	 * @return KornIcon[]
	 */
	public static function getAll(): array {
		return [
			self::n0(),
			self::n1(),
			self::n2(),
			self::n3(),
			self::n4(),
			self::n5(),
			self::n6(),
			self::n7(),
			self::n8(),
			self::n9(),
			self::a(),
			self::addressBook(),
			self::addressCard(),
			self::alignCenter(),
			self::alignJustify(),
			self::alignLeft(),
			self::alignRight(),
			self::anchor(),
			self::anchorCircleCheck(),
			self::anchorCircleExclamation(),
			self::anchorCircleXmark(),
			self::anchorLock(),
			self::angleDown(),
			self::angleLeft(),
			self::angleRight(),
			self::angleUp(),
			self::anglesDown(),
			self::anglesLeft(),
			self::anglesRight(),
			self::anglesUp(),
			self::ankh(),
			self::appleWhole(),
			self::archway(),
			self::arrowDown(),
			self::arrowDown1to9(),
			self::arrowDown9to1(),
			self::arrowDownAtoZ(),
			self::arrowDownLong(),
			self::arrowDownShortWide(),
			self::arrowDownUpAcrossLine(),
			self::arrowDownUpLock(),
			self::arrowDownWideShort(),
			self::arrowDownZtoA(),
			self::arrowLeft(),
			self::arrowLeftLong(),
			self::arrowPointer(),
			self::arrowRight(),
			self::arrowRightArrowLeft(),
			self::arrowRightFromBracket(),
			self::arrowRightLong(),
			self::arrowRightToBracket(),
			self::arrowRightToCity(),
			self::arrowRotateLeft(),
			self::arrowRotateRight(),
			self::arrowTrendDown(),
			self::arrowTrendUp(),
			self::arrowTurnDown(),
			self::arrowTurnUp(),
			self::arrowUp(),
			self::arrowUp1to9(),
			self::arrowUp9to1(),
			self::arrowUpAtoZ(),
			self::arrowUpFromBracket(),
			self::arrowUpFromGroundWater(),
			self::arrowUpFromWaterPump(),
			self::arrowUpLong(),
			self::arrowUpRightDots(),
			self::arrowUpRightFromSquare(),
			self::arrowUpShortWide(),
			self::arrowUpWideShort(),
			self::arrowUpZtoA(),
			self::arrowsDownToLine(),
			self::arrowsDownToPeople(),
			self::arrowsLeftRight(),
			self::arrowsLeftRightToLine(),
			self::arrowsRotate(),
			self::arrowsSpin(),
			self::arrowsSplitUpAndLeft(),
			self::arrowsToCircle(),
			self::arrowsToDot(),
			self::arrowsToEye(),
			self::arrowsTurnRight(),
			self::arrowsTurnToDots(),
			self::arrowsUpDown(),
			self::arrowsUpDownLeftRight(),
			self::arrowsUpToLine(),
			self::asterisk(),
			self::at(),
			self::atom(),
			self::audioDescription(),
			self::australSign(),
			self::award(),
			self::b(),
			self::baby(),
			self::babyCarriage(),
			self::backward(),
			self::backwardFast(),
			self::backwardStep(),
			self::bacon(),
			self::bacteria(),
			self::bacterium(),
			self::bagShopping(),
			self::bahai(),
			self::bahtSign(),
			self::ban(),
			self::banSmoking(),
			self::bandage(),
			self::bangladeshiTakaSign(),
			self::barcode(),
			self::bars(),
			self::barsProgress(),
			self::barsStaggered(),
			self::baseball(),
			self::baseballBatBall(),
			self::basketShopping(),
			self::basketball(),
			self::bath(),
			self::batteryEmpty(),
			self::batteryFull(),
			self::batteryHalf(),
			self::batteryQuarter(),
			self::batteryThreeQuarters(),
			self::bed(),
			self::bedPulse(),
			self::beerMugEmpty(),
			self::bell(),
			self::bellConcierge(),
			self::bellSlash(),
			self::bezierCurve(),
			self::bicycle(),
			self::binoculars(),
			self::biohazard(),
			self::bitcoinSign(),
			self::blender(),
			self::blenderPhone(),
			self::blog(),
			self::bold(),
			self::bolt(),
			self::boltLightning(),
			self::bomb(),
			self::bone(),
			self::bong(),
			self::book(),
			self::bookAtlas(),
			self::bookBible(),
			self::bookBookmark(),
			self::bookJournalWhills(),
			self::bookMedical(),
			self::bookOpen(),
			self::bookOpenReader(),
			self::bookQuran(),
			self::bookSkull(),
			self::bookTanakh(),
			self::bookmark(),
			self::borderAll(),
			self::borderNone(),
			self::borderTopLeft(),
			self::boreHole(),
			self::bottleDroplet(),
			self::bottleWater(),
			self::bowlFood(),
			self::bowlRice(),
			self::bowlingBall(),
			self::box(),
			self::boxArchive(),
			self::boxOpen(),
			self::boxTissue(),
			self::boxesPacking(),
			self::boxesStacked(),
			self::braille(),
			self::brain(),
			self::brazilianRealSign(),
			self::breadSlice(),
			self::bridge(),
			self::bridgeCircleCheck(),
			self::bridgeCircleExclamation(),
			self::bridgeCircleXmark(),
			self::bridgeLock(),
			self::bridgeWater(),
			self::briefcase(),
			self::briefcaseMedical(),
			self::broom(),
			self::broomBall(),
			self::brush(),
			self::bucket(),
			self::bug(),
			self::bugSlash(),
			self::bugs(),
			self::building(),
			self::buildingCircleArrowRight(),
			self::buildingCircleCheck(),
			self::buildingCircleExclamation(),
			self::buildingCircleXmark(),
			self::buildingColumns(),
			self::buildingFlag(),
			self::buildingLock(),
			self::buildingNgo(),
			self::buildingShield(),
			self::buildingUn(),
			self::buildingUser(),
			self::buildingWheat(),
			self::bullhorn(),
			self::bullseye(),
			self::burger(),
			self::burst(),
			self::bus(),
			self::busSimple(),
			self::businessTime(),
			self::c(),
			self::cableCar(),
			self::cakeCandles(),
			self::calculator(),
			self::calendar(),
			self::calendarCheck(),
			self::calendarDay(),
			self::calendarDays(),
			self::calendarMinus(),
			self::calendarPlus(),
			self::calendarWeek(),
			self::calendarXmark(),
			self::camera(),
			self::cameraRetro(),
			self::cameraRotate(),
			self::campground(),
			self::candyCane(),
			self::cannabis(),
			self::capsules(),
			self::car(),
			self::carBattery(),
			self::carBurst(),
			self::carOn(),
			self::carRear(),
			self::carSide(),
			self::carTunnel(),
			self::caravan(),
			self::caretDown(),
			self::caretLeft(),
			self::caretRight(),
			self::caretUp(),
			self::carrot(),
			self::cartArrowDown(),
			self::cartFlatbed(),
			self::cartFlatbedSuitcase(),
			self::cartPlus(),
			self::cartShopping(),
			self::cashRegister(),
			self::cat(),
			self::cediSign(),
			self::centSign(),
			self::certificate(),
			self::chair(),
			self::chalkboard(),
			self::chalkboardUser(),
			self::champagneGlasses(),
			self::chargingStation(),
			self::chartArea(),
			self::chartBar(),
			self::chartColumn(),
			self::chartGantt(),
			self::chartLine(),
			self::chartPie(),
			self::chartSimple(),
			self::check(),
			self::checkDouble(),
			self::checkToSlot(),
			self::cheese(),
			self::chess(),
			self::chessBishop(),
			self::chessBoard(),
			self::chessKing(),
			self::chessKnight(),
			self::chessPawn(),
			self::chessQueen(),
			self::chessRook(),
			self::chevronDown(),
			self::chevronLeft(),
			self::chevronRight(),
			self::chevronUp(),
			self::child(),
			self::childCombatant(),
			self::childDress(),
			self::childReaching(),
			self::children(),
			self::church(),
			self::circle(),
			self::circleArrowDown(),
			self::circleArrowLeft(),
			self::circleArrowRight(),
			self::circleArrowUp(),
			self::circleCheck(),
			self::circleChevronDown(),
			self::circleChevronLeft(),
			self::circleChevronRight(),
			self::circleChevronUp(),
			self::circleDollarToSlot(),
			self::circleDot(),
			self::circleDown(),
			self::circleExclamation(),
			self::circleH(),
			self::circleHalfStroke(),
			self::circleInfo(),
			self::circleLeft(),
			self::circleMinus(),
			self::circleNodes(),
			self::circleNotch(),
			self::circlePause(),
			self::circlePlay(),
			self::circlePlus(),
			self::circleQuestion(),
			self::circleRadiation(),
			self::circleRight(),
			self::circleStop(),
			self::circleUp(),
			self::circleUser(),
			self::circleXmark(),
			self::city(),
			self::clapperboard(),
			self::clipboard(),
			self::clipboardCheck(),
			self::clipboardList(),
			self::clipboardQuestion(),
			self::clipboardUser(),
			self::clock(),
			self::clockRotateLeft(),
			self::clone(),
			self::closedCaptioning(),
			self::cloud(),
			self::cloudArrowDown(),
			self::cloudArrowUp(),
			self::cloudBolt(),
			self::cloudMeatball(),
			self::cloudMoon(),
			self::cloudMoonRain(),
			self::cloudRain(),
			self::cloudShowersHeavy(),
			self::cloudShowersWater(),
			self::cloudSun(),
			self::cloudSunRain(),
			self::clover(),
			self::code(),
			self::codeBranch(),
			self::codeCommit(),
			self::codeCompare(),
			self::codeFork(),
			self::codeMerge(),
			self::codePullRequest(),
			self::coins(),
			self::colonSign(),
			self::comment(),
			self::commentDollar(),
			self::commentDots(),
			self::commentMedical(),
			self::commentSlash(),
			self::commentSms(),
			self::comments(),
			self::commentsDollar(),
			self::compactDisc(),
			self::compass(),
			self::compassDrafting(),
			self::compress(),
		];
	}

	// PAGE 1
	public static function n0(): self { return new KornIcon("0"); }
	public static function n1(): self { return new KornIcon("1"); }
	public static function n2(): self { return new KornIcon("2"); }
	public static function n3(): self { return new KornIcon("3"); }
	public static function n4(): self { return new KornIcon("4"); }
	public static function n5(): self { return new KornIcon("5"); }
	public static function n6(): self { return new KornIcon("6"); }
	public static function n7(): self { return new KornIcon("7"); }
	public static function n8(): self { return new KornIcon("8"); }
	public static function n9(): self { return new KornIcon("9"); }
	public static function a(): self { return new KornIcon("a"); }
	public static function addressBook(): self { return new KornIcon("address-book"); }
	public static function addressCard(): self { return new KornIcon("address-card"); }
	public static function alignCenter(): self { return new KornIcon("align-center"); }
	public static function alignJustify(): self { return new KornIcon("align-justify"); }
	public static function alignLeft(): self { return new KornIcon("align-left"); }
	public static function alignRight(): self { return new KornIcon("align-right"); }
	public static function anchor(): self { return new KornIcon("anchor"); }
	public static function anchorCircleCheck(): self { return new KornIcon("anchor-circle-check"); }
	public static function anchorCircleExclamation(): self { return new KornIcon("anchor-circle-exclamation"); }
	public static function anchorCircleXmark(): self { return new KornIcon("anchor-circle-xmark"); }
	public static function anchorLock(): self { return new KornIcon("anchor-lock"); }
	public static function angleDown(): self { return new KornIcon("angle-down"); }
	public static function angleLeft(): self { return new KornIcon("angle-left"); }
	public static function angleRight(): self { return new KornIcon("angle-right"); }
	public static function angleUp(): self { return new KornIcon("angle-up"); }
	public static function anglesDown(): self { return new KornIcon("angles-down"); }
	public static function anglesLeft(): self { return new KornIcon("angles-left"); }
	public static function anglesRight(): self { return new KornIcon("angles-right"); }
	public static function anglesUp(): self { return new KornIcon("angles-up"); }
	public static function ankh(): self { return new KornIcon("ankh"); }
	public static function appleWhole(): self { return new KornIcon("apple-whole"); }
	public static function archway(): self { return new KornIcon("archway"); }
	public static function arrowDown(): self { return new KornIcon("arrow-down"); }
	public static function arrowDown1to9(): self { return new KornIcon("arrow-down-1-9"); }
	public static function arrowDown9to1(): self { return new KornIcon("arrow-down-9-1"); }
	public static function arrowDownAtoZ(): self { return new KornIcon("arrow-down-a-z"); }
	public static function arrowDownLong(): self { return new KornIcon("arrow-down-long"); }
	public static function arrowDownShortWide(): self { return new KornIcon("arrow-down-short-wide"); }
	public static function arrowDownUpAcrossLine(): self { return new KornIcon("arrow-down-up-across-line"); }
	public static function arrowDownUpLock(): self { return new KornIcon("arrow-down-up-lock"); }
	public static function arrowDownWideShort(): self { return new KornIcon("arrow-down-wide-short"); }
	public static function arrowDownZtoA(): self { return new KornIcon("arrow-down-z-a"); }
	public static function arrowLeft(): self { return new KornIcon("arrow-left"); }
	public static function arrowLeftLong(): self { return new KornIcon("arrow-left-long"); }
	public static function arrowPointer(): self { return new KornIcon("arrow-pointer"); }
	public static function arrowRight(): self { return new KornIcon("arrow-right"); }
	public static function arrowRightArrowLeft(): self { return new KornIcon("arrow-right-arrow-left"); }
	public static function arrowRightFromBracket(): self { return new KornIcon("arrow-right-from-bracket"); }
	public static function arrowRightLong(): self { return new KornIcon("arrow-right-long"); }
	public static function arrowRightToBracket(): self { return new KornIcon("arrow-right-to-bracket"); }
	public static function arrowRightToCity(): self { return new KornIcon("arrow-right-to-city"); }
	public static function arrowRotateLeft(): self { return new KornIcon("arrow-rotate-left"); }
	public static function arrowRotateRight(): self { return new KornIcon("arrow-rotate-right"); }
	public static function arrowTrendDown(): self { return new KornIcon("arrow-trend-down"); }
	public static function arrowTrendUp(): self { return new KornIcon("arrow-trend-up"); }
	public static function arrowTurnDown(): self { return new KornIcon("arrow-turn-down"); }
	public static function arrowTurnUp(): self { return new KornIcon("arrow-turn-up"); }
	public static function arrowUp(): self { return new KornIcon("arrow-up"); }
	public static function arrowUp1to9(): self { return new KornIcon("arrow-up-1-9"); }
	public static function arrowUp9to1(): self { return new KornIcon("arrow-up-9-1"); }
	public static function arrowUpAtoZ(): self { return new KornIcon("arrow-up-a-z"); }
	public static function arrowUpFromBracket(): self { return new KornIcon("arrow-up-from-bracket"); }
	public static function arrowUpFromGroundWater(): self { return new KornIcon("arrow-up-from-ground-water"); }
	public static function arrowUpFromWaterPump(): self { return new KornIcon("arrow-up-from-water-pump"); }
	public static function arrowUpLong(): self { return new KornIcon("arrow-up-long"); }
	public static function arrowUpRightDots(): self { return new KornIcon("arrow-up-right-dots"); }
	public static function arrowUpRightFromSquare(): self { return new KornIcon("arrow-up-right-from-square"); }
	public static function arrowUpShortWide(): self { return new KornIcon("arrow-up-short-wide"); }
	public static function arrowUpWideShort(): self { return new KornIcon("arrow-up-wide-short"); }
	public static function arrowUpZtoA(): self { return new KornIcon("arrow-up-z-a"); }
	public static function arrowsDownToLine(): self { return new KornIcon("arrows-down-to-line"); }
	public static function arrowsDownToPeople(): self { return new KornIcon("arrows-down-to-people"); }
	public static function arrowsLeftRight(): self { return new KornIcon("arrows-left-right"); }
	public static function arrowsLeftRightToLine(): self { return new KornIcon("arrows-left-right-to-line"); }
	public static function arrowsRotate(): self { return new KornIcon("arrows-rotate"); }
	public static function arrowsSpin(): self { return new KornIcon("arrows-spin"); }
	public static function arrowsSplitUpAndLeft(): self { return new KornIcon("arrows-split-up-and-left"); }
	public static function arrowsToCircle(): self { return new KornIcon("arrows-to-circle"); }
	public static function arrowsToDot(): self { return new KornIcon("arrows-to-dot"); }
	public static function arrowsToEye(): self { return new KornIcon("arrows-to-eye"); }
	public static function arrowsTurnRight(): self { return new KornIcon("arrows-turn-right"); }
	public static function arrowsTurnToDots(): self { return new KornIcon("arrows-turn-to-dots"); }
	public static function arrowsUpDown(): self { return new KornIcon("arrows-up-down"); }
	public static function arrowsUpDownLeftRight(): self { return new KornIcon("arrows-up-down-left-right"); }
	public static function arrowsUpToLine(): self { return new KornIcon("arrows-up-to-line"); }
	public static function asterisk(): self { return new KornIcon("asterisk"); }
	public static function at(): self { return new KornIcon("at"); }
	public static function atom(): self { return new KornIcon("atom"); }
	public static function audioDescription(): self { return new KornIcon("audio-description"); }
	public static function australSign(): self { return new KornIcon("austral-sign"); }
	public static function award(): self { return new KornIcon("award"); }
	public static function b(): self { return new KornIcon("b"); }
	public static function baby(): self { return new KornIcon("baby"); }
	public static function babyCarriage(): self { return new KornIcon("baby-carriage"); }
	public static function backward(): self { return new KornIcon("backward"); }
	public static function backwardFast(): self { return new KornIcon("backward-fast"); }
	public static function backwardStep(): self { return new KornIcon("backward-step"); }
	public static function bacon(): self { return new KornIcon("bacon"); }
	public static function bacteria(): self { return new KornIcon("bacteria"); }
	public static function bacterium(): self { return new KornIcon("bacterium"); }
	public static function bagShopping(): self { return new KornIcon("bag-shopping"); }
	public static function bahai(): self { return new KornIcon("bahai"); }
	public static function bahtSign(): self { return new KornIcon("baht-sign"); }
	public static function ban(): self { return new KornIcon("ban"); }
	public static function banSmoking(): self { return new KornIcon("ban-smoking"); }
	public static function bandage(): self { return new KornIcon("bandage"); }
	public static function bangladeshiTakaSign(): self { return new KornIcon("bangladeshi-taka-sign"); }
	public static function barcode(): self { return new KornIcon("barcode"); }
	public static function bars(): self { return new KornIcon("bars"); }
	public static function barsProgress(): self { return new KornIcon("bars-progress"); }
	public static function barsStaggered(): self { return new KornIcon("bars-staggered"); }
	public static function baseball(): self { return new KornIcon("baseball"); }
	public static function baseballBatBall(): self { return new KornIcon("baseball-bat-ball"); }
	public static function basketShopping(): self { return new KornIcon("basket-shopping"); }
	public static function basketball(): self { return new KornIcon("basketball"); }
	public static function bath(): self { return new KornIcon("bath"); }
	public static function batteryEmpty(): self { return new KornIcon("battery-empty"); }
	public static function batteryFull(): self { return new KornIcon("battery-full"); }
	public static function batteryHalf(): self { return new KornIcon("battery-half"); }
	public static function batteryQuarter(): self { return new KornIcon("battery-quarter"); }
	public static function batteryThreeQuarters(): self { return new KornIcon("battery-three-quarters"); }
	public static function bed(): self { return new KornIcon("bed"); }
	public static function bedPulse(): self { return new KornIcon("bed-pulse"); }
	public static function beerMugEmpty(): self { return new KornIcon("beer-mug-empty"); }
	public static function bell(): self { return new KornIcon("bell"); }
	public static function bellConcierge(): self { return new KornIcon("bell-concierge"); }
	public static function bellSlash(): self { return new KornIcon("bell-slash"); }
	public static function bezierCurve(): self { return new KornIcon("bezier-curve"); }
	public static function bicycle(): self { return new KornIcon("bicycle"); }
	public static function binoculars(): self { return new KornIcon("binoculars"); }
	public static function biohazard(): self { return new KornIcon("biohazard"); }
	public static function bitcoinSign(): self { return new KornIcon("bitcoin-sign"); }
	public static function blender(): self { return new KornIcon("blender"); }
	public static function blenderPhone(): self { return new KornIcon("blender-phone"); }
	public static function blog(): self { return new KornIcon("blog"); }
	public static function bold(): self { return new KornIcon("bold"); }
	public static function bolt(): self { return new KornIcon("bolt"); }
	public static function boltLightning(): self { return new KornIcon("bolt-lightning"); }
	public static function bomb(): self { return new KornIcon("bomb"); }
	public static function bone(): self { return new KornIcon("bone"); }
	public static function bong(): self { return new KornIcon("bong"); }
	public static function book(): self { return new KornIcon("book"); }
	public static function bookAtlas(): self { return new KornIcon("book-atlas"); }
	public static function bookBible(): self { return new KornIcon("book-bible"); }
	public static function bookBookmark(): self { return new KornIcon("book-bookmark"); }
	public static function bookJournalWhills(): self { return new KornIcon("book-journal-whills"); }
	public static function bookMedical(): self { return new KornIcon("book-medical"); }
	public static function bookOpen(): self { return new KornIcon("book-open"); }
	public static function bookOpenReader(): self { return new KornIcon("book-open-reader"); }
	public static function bookQuran(): self { return new KornIcon("book-quran"); }
	public static function bookSkull(): self { return new KornIcon("book-skull"); }
	public static function bookTanakh(): self { return new KornIcon("book-tanakh"); }
	public static function bookmark(): self { return new KornIcon("bookmark"); }
	public static function borderAll(): self { return new KornIcon("border-all"); }
	public static function borderNone(): self { return new KornIcon("border-none"); }
	public static function borderTopLeft(): self { return new KornIcon("border-top-left"); }
	public static function boreHole(): self { return new KornIcon("bore-hole"); }
	public static function bottleDroplet(): self { return new KornIcon("bottle-droplet"); }
	public static function bottleWater(): self { return new KornIcon("bottle-water"); }
	public static function bowlFood(): self { return new KornIcon("bowl-food"); }
	public static function bowlRice(): self { return new KornIcon("bowl-rice"); }
	public static function bowlingBall(): self { return new KornIcon("bowling-ball"); }
	public static function box(): self { return new KornIcon("box"); }
	public static function boxArchive(): self { return new KornIcon("box-archive"); }
	public static function boxOpen(): self { return new KornIcon("box-open"); }
	public static function boxTissue(): self { return new KornIcon("box-tissue"); }
	public static function boxesPacking(): self { return new KornIcon("boxes-packing"); }
	public static function boxesStacked(): self { return new KornIcon("boxes-stacked"); }
	public static function braille(): self { return new KornIcon("braille"); }
	public static function brain(): self { return new KornIcon("brain"); }
	public static function brazilianRealSign(): self { return new KornIcon("brazilian-real-sign"); }
	public static function breadSlice(): self { return new KornIcon("bread-slice"); }
	public static function bridge(): self { return new KornIcon("bridge"); }
	public static function bridgeCircleCheck(): self { return new KornIcon("bridge-circle-check"); }
	public static function bridgeCircleExclamation(): self { return new KornIcon("bridge-circle-exclamation"); }
	public static function bridgeCircleXmark(): self { return new KornIcon("bridge-circle-xmark"); }
	public static function bridgeLock(): self { return new KornIcon("bridge-lock"); }
	public static function bridgeWater(): self { return new KornIcon("bridge-water"); }
	public static function briefcase(): self { return new KornIcon("briefcase"); }

	// PAGE 2
	public static function briefcaseMedical(): self { return new KornIcon("briefcase-medical"); }
	public static function broom(): self { return new KornIcon("broom"); }
	public static function broomBall(): self { return new KornIcon("broom-ball"); }
	public static function brush(): self { return new KornIcon("brush"); }
	public static function bucket(): self { return new KornIcon("bucket"); }
	public static function bug(): self { return new KornIcon("bug"); }
	public static function bugSlash(): self { return new KornIcon("bug-slash"); }
	public static function bugs(): self { return new KornIcon("bugs"); }
	public static function building(): self { return new KornIcon("building"); }
	public static function buildingCircleArrowRight(): self { return new KornIcon("building-circle-arrow-right"); }
	public static function buildingCircleCheck(): self { return new KornIcon("building-circle-check"); }
	public static function buildingCircleExclamation(): self { return new KornIcon("building-circle-exclamation"); }
	public static function buildingCircleXmark(): self { return new KornIcon("building-circle-xmark"); }
	public static function buildingColumns(): self { return new KornIcon("building-columns"); }
	public static function buildingFlag(): self { return new KornIcon("building-flag"); }
	public static function buildingLock(): self { return new KornIcon("building-lock"); }
	public static function buildingNgo(): self { return new KornIcon("building-ngo"); }
	public static function buildingShield(): self { return new KornIcon("building-shield"); }
	public static function buildingUn(): self { return new KornIcon("building-un"); }
	public static function buildingUser(): self { return new KornIcon("building-user"); }
	public static function buildingWheat(): self { return new KornIcon("building-wheat"); }
	public static function bullhorn(): self { return new KornIcon("bullhorn"); }
	public static function bullseye(): self { return new KornIcon("bullseye"); }
	public static function burger(): self { return new KornIcon("burger"); }
	public static function burst(): self { return new KornIcon("burst"); }
	public static function bus(): self { return new KornIcon("bus"); }
	public static function busSimple(): self { return new KornIcon("bus-simple"); }
	public static function businessTime(): self { return new KornIcon("business-time"); }
	public static function c(): self { return new KornIcon("c"); }
	public static function cableCar(): self { return new KornIcon("cable-car"); }
	public static function cakeCandles(): self { return new KornIcon("cake-candles"); }
	public static function calculator(): self { return new KornIcon("calculator"); }
	public static function calendar(): self { return new KornIcon("calendar"); }
	public static function calendarCheck(): self { return new KornIcon("calendar-check"); }
	public static function calendarDay(): self { return new KornIcon("calendar-day"); }
	public static function calendarDays(): self { return new KornIcon("calendar-days"); }
	public static function calendarMinus(): self { return new KornIcon("calendar-minus"); }
	public static function calendarPlus(): self { return new KornIcon("calendar-plus"); }
	public static function calendarWeek(): self { return new KornIcon("calendar-week"); }
	public static function calendarXmark(): self { return new KornIcon("calendar-xmark"); }
	public static function camera(): self { return new KornIcon("camera"); }
	public static function cameraRetro(): self { return new KornIcon("camera-retro"); }
	public static function cameraRotate(): self { return new KornIcon("camera-rotate"); }
	public static function campground(): self { return new KornIcon("campground"); }
	public static function candyCane(): self { return new KornIcon("candy-cane"); }
	public static function cannabis(): self { return new KornIcon("cannabis"); }
	public static function capsules(): self { return new KornIcon("capsules"); }
	public static function car(): self { return new KornIcon("car"); }
	public static function carBattery(): self { return new KornIcon("car-battery"); }
	public static function carBurst(): self { return new KornIcon("car-burst"); }
	public static function carOn(): self { return new KornIcon("car-on"); }
	public static function carRear(): self { return new KornIcon("car-rear"); }
	public static function carSide(): self { return new KornIcon("car-side"); }
	public static function carTunnel(): self { return new KornIcon("car-tunnel"); }
	public static function caravan(): self { return new KornIcon("caravan"); }
	public static function caretDown(): self { return new KornIcon("caret-down"); }
	public static function caretLeft(): self { return new KornIcon("caret-left"); }
	public static function caretRight(): self { return new KornIcon("caret-right"); }
	public static function caretUp(): self { return new KornIcon("caret-up"); }
	public static function carrot(): self { return new KornIcon("carrot"); }
	public static function cartArrowDown(): self { return new KornIcon("cart-arrow-down"); }
	public static function cartFlatbed(): self { return new KornIcon("cart-flatbed"); }
	public static function cartFlatbedSuitcase(): self { return new KornIcon("cart-flatbed-suitcase"); }
	public static function cartPlus(): self { return new KornIcon("cart-plus"); }
	public static function cartShopping(): self { return new KornIcon("cart-shopping"); }
	public static function cashRegister(): self { return new KornIcon("cash-register"); }
	public static function cat(): self { return new KornIcon("cat"); }
	public static function cediSign(): self { return new KornIcon("cedi-sign"); }
	public static function centSign(): self { return new KornIcon("cent-sign"); }
	public static function certificate(): self { return new KornIcon("certificate"); }
	public static function chair(): self { return new KornIcon("chair"); }
	public static function chalkboard(): self { return new KornIcon("chalkboard"); }
	public static function chalkboardUser(): self { return new KornIcon("chalkboard-user"); }
	public static function champagneGlasses(): self { return new KornIcon("champagne-glasses"); }
	public static function chargingStation(): self { return new KornIcon("charging-station"); }
	public static function chartArea(): self { return new KornIcon("chart-area"); }
	public static function chartBar(): self { return new KornIcon("chart-bar"); }
	public static function chartColumn(): self { return new KornIcon("chart-column"); }
	public static function chartGantt(): self { return new KornIcon("chart-gantt"); }
	public static function chartLine(): self { return new KornIcon("chart-line"); }
	public static function chartPie(): self { return new KornIcon("chart-pie"); }
	public static function chartSimple(): self { return new KornIcon("chart-simple"); }
	public static function check(): self { return new KornIcon("check"); }
	public static function checkDouble(): self { return new KornIcon("check-double"); }
	public static function checkToSlot(): self { return new KornIcon("check-to-slot"); }
	public static function cheese(): self { return new KornIcon("cheese"); }
	public static function chess(): self { return new KornIcon("chess"); }
	public static function chessBishop(): self { return new KornIcon("chess-bishop"); }
	public static function chessBoard(): self { return new KornIcon("chess-board"); }
	public static function chessKing(): self { return new KornIcon("chess-king"); }
	public static function chessKnight(): self { return new KornIcon("chess-knight"); }
	public static function chessPawn(): self { return new KornIcon("chess-pawn"); }
	public static function chessQueen(): self { return new KornIcon("chess-queen"); }
	public static function chessRook(): self { return new KornIcon("chess-rook"); }
	public static function chevronDown(): self { return new KornIcon("chevron-down"); }
	public static function chevronLeft(): self { return new KornIcon("chevron-left"); }
	public static function chevronRight(): self { return new KornIcon("chevron-right"); }
	public static function chevronUp(): self { return new KornIcon("chevron-up"); }
	public static function child(): self { return new KornIcon("child"); }
	public static function childCombatant(): self { return new KornIcon("child-combatant"); }
	public static function childDress(): self { return new KornIcon("child-dress"); }
	public static function childReaching(): self { return new KornIcon("child-reaching"); }
	public static function children(): self { return new KornIcon("children"); }
	public static function church(): self { return new KornIcon("church"); }
	public static function circle(): self { return new KornIcon("circle"); }
	public static function circleArrowDown(): self { return new KornIcon("circle-arrow-down"); }
	public static function circleArrowLeft(): self { return new KornIcon("circle-arrow-left"); }
	public static function circleArrowRight(): self { return new KornIcon("circle-arrow-right"); }
	public static function circleArrowUp(): self { return new KornIcon("circle-arrow-up"); }
	public static function circleCheck(): self { return new KornIcon("circle-check"); }
	public static function circleChevronDown(): self { return new KornIcon("circle-chevron-down"); }
	public static function circleChevronLeft(): self { return new KornIcon("circle-chevron-left"); }
	public static function circleChevronRight(): self { return new KornIcon("circle-chevron-right"); }
	public static function circleChevronUp(): self { return new KornIcon("circle-chevron-up"); }
	public static function circleDollarToSlot(): self { return new KornIcon("circle-dollar-to-slot"); }
	public static function circleDot(): self { return new KornIcon("circle-dot"); }
	public static function circleDown(): self { return new KornIcon("circle-down"); }
	public static function circleExclamation(): self { return new KornIcon("circle-exclamation"); }
	public static function circleH(): self { return new KornIcon("circle-h"); }
	public static function circleHalfStroke(): self { return new KornIcon("circle-half-stroke"); }
	public static function circleInfo(): self { return new KornIcon("circle-info"); }
	public static function circleLeft(): self { return new KornIcon("circle-left"); }
	public static function circleMinus(): self { return new KornIcon("circle-minus"); }
	public static function circleNodes(): self { return new KornIcon("circle-nodes"); }
	public static function circleNotch(): self { return new KornIcon("circle-notch"); }
	public static function circlePause(): self { return new KornIcon("circle-pause"); }
	public static function circlePlay(): self { return new KornIcon("circle-play"); }
	public static function circlePlus(): self { return new KornIcon("circle-plus"); }
	public static function circleQuestion(): self { return new KornIcon("circle-question"); }
	public static function circleRadiation(): self { return new KornIcon("circle-radiation"); }
	public static function circleRight(): self { return new KornIcon("circle-right"); }
	public static function circleStop(): self { return new KornIcon("circle-stop"); }
	public static function circleUp(): self { return new KornIcon("circle-up"); }
	public static function circleUser(): self { return new KornIcon("circle-user"); }
	public static function circleXmark(): self { return new KornIcon("circle-xmark"); }
	public static function city(): self { return new KornIcon("city"); }
	public static function clapperboard(): self { return new KornIcon("clapperboard"); }
	public static function clipboard(): self { return new KornIcon("clipboard"); }
	public static function clipboardCheck(): self { return new KornIcon("clipboard-check"); }
	public static function clipboardList(): self { return new KornIcon("clipboard-list"); }
	public static function clipboardQuestion(): self { return new KornIcon("clipboard-question"); }
	public static function clipboardUser(): self { return new KornIcon("clipboard-user"); }
	public static function clock(): self { return new KornIcon("clock"); }
	public static function clockRotateLeft(): self { return new KornIcon("clock-rotate-left"); }
	public static function clone(): self { return new KornIcon("clone"); }
	public static function closedCaptioning(): self { return new KornIcon("closed-captioning"); }
	public static function cloud(): self { return new KornIcon("cloud"); }
	public static function cloudArrowDown(): self { return new KornIcon("cloud-arrow-down"); }
	public static function cloudArrowUp(): self { return new KornIcon("cloud-arrow-up"); }
	public static function cloudBolt(): self { return new KornIcon("cloud-bolt"); }
	public static function cloudMeatball(): self { return new KornIcon("cloud-meatball"); }
	public static function cloudMoon(): self { return new KornIcon("cloud-moon"); }
	public static function cloudMoonRain(): self { return new KornIcon("cloud-moon-rain"); }
	public static function cloudRain(): self { return new KornIcon("cloud-rain"); }
	public static function cloudShowersHeavy(): self { return new KornIcon("cloud-showers-heavy"); }
	public static function cloudShowersWater(): self { return new KornIcon("cloud-showers-water"); }
	public static function cloudSun(): self { return new KornIcon("cloud-sun"); }
	public static function cloudSunRain(): self { return new KornIcon("cloud-sun-rain"); }
	public static function clover(): self { return new KornIcon("clover"); }
	public static function code(): self { return new KornIcon("code"); }
	public static function codeBranch(): self { return new KornIcon("code-branch"); }
	public static function codeCommit(): self { return new KornIcon("code-commit"); }
	public static function codeCompare(): self { return new KornIcon("code-compare"); }
	public static function codeFork(): self { return new KornIcon("code-fork"); }
	public static function codeMerge(): self { return new KornIcon("code-merge"); }
	public static function codePullRequest(): self { return new KornIcon("code-pull-request"); }
	public static function coins(): self { return new KornIcon("coins"); }
	public static function colonSign(): self { return new KornIcon("colon-sign"); }
	public static function comment(): self { return new KornIcon("comment"); }
	public static function commentDollar(): self { return new KornIcon("comment-dollar"); }
	public static function commentDots(): self { return new KornIcon("comment-dots"); }
	public static function commentMedical(): self { return new KornIcon("comment-medical"); }
	public static function commentSlash(): self { return new KornIcon("comment-slash"); }
	public static function commentSms(): self { return new KornIcon("comment-sms"); }
	public static function comments(): self { return new KornIcon("comments"); }
	public static function commentsDollar(): self { return new KornIcon("comments-dollar"); }
	public static function compactDisc(): self { return new KornIcon("compact-disc"); }
	public static function compass(): self { return new KornIcon("compass"); }
	public static function compassDrafting(): self { return new KornIcon("compass-drafting"); }
	public static function compress(): self { return new KornIcon("compress"); }

	// PAGE 3


	public static function cog(): self { return new KornIcon("cog"); }
	public static function exclamation(): self { return new KornIcon("exclamation"); }
	public static function ellipsisVertical(): self { return new KornIcon("ellipsis-vertical"); }
	public static function penToSquare(): self { return new KornIcon("pen-to-square"); }
	public static function rotateLeft(): self { return new KornIcon("rotate-left"); }
	public static function rightFromBracket(): self { return new KornIcon("right-from-bracket"); }
	public static function rightToBracket(): self { return new KornIcon("right-to-bracket"); }
	public static function trashCan(): self { return new KornIcon("trash-can"); }
	public static function spinner(): self { return new KornIcon("spinner"); }
	public static function hand(): self { return new KornIcon("hand"); }
	public static function plus(): self { return new KornIcon("plus"); }
	public static function question(): self { return new KornIcon("question"); }
	public static function graduationCap(): self { return new KornIcon("graduation-cap"); }
	public static function phone(): self { return new KornIcon("phone"); }
	public static function list(): self { return new KornIcon("list"); }
	public static function turnDown(): self { return new KornIcon("turn-down"); }
	public static function turnUp(): self { return new KornIcon("turn-up"); }
	public static function user(): self { return new KornIcon("user"); }
	public static function wallet(): self { return new KornIcon("wallet"); }
	public static function tag(): self { return new KornIcon("tag"); }
}