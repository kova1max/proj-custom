<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

// TODO:
// 1. Доробити пусту корзину ->
// include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

$delivery = 300;

?>

	<?$APPLICATION->IncludeComponent(
		"bitrix:sale.order.ajax",
		"custom-order",
		Array(
			"ACTION_VARIABLE" => "soa-action",
			"ADDITIONAL_PICT_PROP_14" => "-",
			"ADDITIONAL_PICT_PROP_15" => "-",
			"ALLOW_APPEND_ORDER" => "Y",
			"ALLOW_AUTO_REGISTER" => "Y",
			"ALLOW_NEW_PROFILE" => "N",
			"ALLOW_USER_PROFILES" => "N",
			"BASKET_IMAGES_SCALING" => "adaptive",
			"BASKET_POSITION" => "after",
			"COMPATIBLE_MODE" => "Y",
			"DELIVERIES_PER_PAGE" => "9",
			"DELIVERY_FADE_EXTRA_SERVICES" => "N",
			"DELIVERY_NO_AJAX" => "N",
			"DELIVERY_NO_SESSION" => "N",
			"DELIVERY_TO_PAYSYSTEM" => "d2p",
			"DISABLE_BASKET_REDIRECT" => "N",
			"EMPTY_BASKET_HINT_PATH" => "/",
			"HIDE_ORDER_DESCRIPTION" => "N",
			"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
			"PATH_TO_AUTH" => "/auth/",
			"PATH_TO_BASKET" => "/personal/cart/",
			"PATH_TO_PAYMENT" => "payment.php",
			"PATH_TO_PERSONAL" => "index.php",
			"PAY_FROM_ACCOUNT" => "N",
			"PAY_SYSTEMS_PER_PAGE" => "9",
			"PICKUPS_PER_PAGE" => "5",
			"PICKUP_MAP_TYPE" => "yandex",
			"PRODUCT_COLUMNS_HIDDEN" => array(0=>"PREVIEW_PICTURE",1=>"DETAIL_PICTURE",2=>"PREVIEW_TEXT",3=>"PROPS",4=>"NOTES",5=>"DISCOUNT_PRICE_PERCENT_FORMATED",6=>"PRICE_FORMATED",7=>"WEIGHT_FORMATED",8=>"PROPERTY_TYPE",9=>"PROPERTY_BRAND",10=>"PROPERTY_FORM",11=>"PROPERTY_HARDNESS",12=>"PROPERTY_OTHER_PICTURES",13=>"PROPERTY_BLOG_POST_ID",14=>"PROPERTY_BLOG_COMMENTS_CNT",15=>"PROPERTY_ADVANTAGES",16=>"PROPERTY_CML2_ARTICLE",17=>"PROPERTY_CERTIFICATES",18=>"PROPERTY_DELIVERY",19=>"PROPERTY_GUARANTEE",20=>"PROPERTY_FAVORITES",21=>"PROPERTY_SIZE",22=>"PROPERTY_PROPS",),
			"PRODUCT_COLUMNS_VISIBLE" => array(0=>"PREVIEW_PICTURE",1=>"DETAIL_PICTURE",2=>"PREVIEW_TEXT",3=>"PROPS",4=>"NOTES",5=>"DISCOUNT_PRICE_PERCENT_FORMATED",6=>"PRICE_FORMATED",7=>"WEIGHT_FORMATED",8=>"PROPERTY_TYPE",9=>"PROPERTY_BRAND",10=>"PROPERTY_FORM",11=>"PROPERTY_HARDNESS",12=>"PROPERTY_OTHER_PICTURES",13=>"PROPERTY_BLOG_POST_ID",14=>"PROPERTY_BLOG_COMMENTS_CNT",15=>"PROPERTY_ADVANTAGES",16=>"PROPERTY_CML2_ARTICLE",17=>"PROPERTY_CERTIFICATES",18=>"PROPERTY_DELIVERY",19=>"PROPERTY_GUARANTEE",20=>"PROPERTY_FAVORITES",21=>"PROPERTY_SIZE",22=>"PROPERTY_PROPS",),
			"PROPS_FADE_LIST_1" => array(0=>"1",1=>"2",2=>"3",3=>"4",4=>"7",),
			"PROPS_FADE_LIST_2" => array(0=>"8",1=>"9",2=>"10",3=>"11",4=>"12",5=>"13",6=>"14",7=>"15",8=>"16",9=>"17",),
			"PROPS_FADE_LIST_3" => array(0=>"18",1=>"19",2=>"20",3=>"21",4=>"22",5=>"23",6=>"24",7=>"25",8=>"26",),
			"SEND_NEW_USER_NOTIFY" => "Y",
			"SERVICES_IMAGES_SCALING" => "adaptive",
			"SET_TITLE" => "Y",
			"SHOW_BASKET_HEADERS" => "N",
			"SHOW_COUPONS" => "N",
			"SHOW_COUPONS_BASKET" => "Y",
			"SHOW_COUPONS_DELIVERY" => "Y",
			"SHOW_COUPONS_PAY_SYSTEM" => "Y",
			"SHOW_DELIVERY_INFO_NAME" => "Y",
			"SHOW_DELIVERY_LIST_NAMES" => "Y",
			"SHOW_DELIVERY_PARENT_NAMES" => "Y",
			"SHOW_MAP_IN_PROPS" => "N",
			"SHOW_NEAREST_PICKUP" => "N",
			"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
			"SHOW_ORDER_BUTTON" => "final_step",
			"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
			"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
			"SHOW_PICKUP_MAP" => "Y",
			"SHOW_STORES_IMAGES" => "Y",
			"SHOW_TOTAL_ORDER_BUTTON" => "N",
			"SHOW_VAT_PRICE" => "N",
			"SKIP_USELESS_BLOCK" => "Y",
			"SPOT_LOCATION_BY_GEOIP" => "Y",
			"TEMPLATE_LOCATION" => "popup",
			"TEMPLATE_THEME" => "site",
			"USER_CONSENT" => "N",
			"USER_CONSENT_ID" => "0",
			"USER_CONSENT_IS_CHECKED" => "N",
			"USER_CONSENT_IS_LOADED" => "N",
			"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
			"USE_CUSTOM_ERROR_MESSAGES" => "N",
			"USE_CUSTOM_MAIN_MESSAGES" => "N",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_PHONE_NORMALIZATION" => "Y",
			"USE_PRELOAD" => "Y",
			"USE_PREPAYMENT" => "N",
			"USE_YM_GOALS" => "N"
		)
	);?>

