<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

IncludeTemplateLangFile(__FILE__);
CModule::IncludeModule("sale");


$basketItems = CSaleBasket::GetList(
        array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
        array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "PRODUCT_ID", "QUANTITY", "PRICE" )
    );
while ($arItems = $basketItems->Fetch())
{
    if (strlen($arItems["CALLBACK_FUNC"]) > 0)
    {
        CSaleBasket::UpdatePrice($arItems["ID"], 
                                 $arItems["CALLBACK_FUNC"], 
                                 $arItems["MODULE"], 
                                 $arItems["PRODUCT_ID"], 
                                 $arItems["QUANTITY"]);
        $arItems = CSaleBasket::GetByID($arItems["ID"]);
    }

    $arBasketItems[] = $arItems;
}

foreach($basketItems->arResult as $item){
	$basket['PRICE'] += $item['PRICE'] * $item['QUANTITY'];
	$basket['QUANTITY'] += $item['QUANTITY'];
}

$compareCount = 0;

foreach($_SESSION['CATALOG_COMPARE_LIST'] as $compare){
	$compare = $compare['ITEMS'];
	$compareCount = count($compare);
	break;
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<title><? $APPLICATION->ShowTitle() ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/bower_components/chosen/chosen.css" />
	<? $APPLICATION->ShowHead(); ?>

	<link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicon/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicon/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= SITE_TEMPLATE_PATH ?>/img/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= SITE_TEMPLATE_PATH ?>/img/favicon/apple-touch-icon-114x114.png">

	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/bower_components/normalize-css/normalize.css" />
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/bower_components/swiper/dist/css/swiper.css" />
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/bower_components/nouislider/distribute/nouislider.min.css" />
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/bower_components/fancyBox/source/jquery.fancybox.css" />
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/bower_components/tooltip/dist/tooltip.css">
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/svg.css">
	<link rel="stylesheet" href="/bitrix/css/main/font-awesome.css">
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/sprite.css">
</head>

<body>

	<? $APPLICATION->ShowPanel() ?>

	<div class="top_menu">
		<div class="container">
			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"super_top",
				array(
					"CLASS" => "top_menu_list",
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "left",
					"COMPONENT_TEMPLATE" => "custom_menu",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => "",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_THEME" => "site",
					"ROOT_MENU_TYPE" => "left",
					"USE_EXT" => "N"
				)
			); ?>
		</div>
	</div>

	<div class="header_w">
		<div class="container">
			<div class="header">

				<div class="header_top">
					<div class="toggle_btn"><span></span></div>
					<div class="header_callback">
						<div class="header_phone">
							<a href="tel:+380662928929" class="header_phone_item">
								<? $APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/include/phone_num.php"
									)
								); ?></a>
							<a href="tel:08005059090" class="header_phone_item">
								<? $APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/include/phone_num2.php"
									)
								); ?></a>
						</div>
						<a href="#" class="btn header_callback_btn">Заказать звонок</a>
					</div>
				</div>
				<a href="/" class="header_logo"><img src="<?= SITE_TEMPLATE_PATH ?>/img/logo.png" alt="Logo"></a>

				<div class="header_right">
					<div class="header_search_w">
						<a href="#" class="header_item_icon"><i class="svg-glass"></i></a>
						<?$APPLICATION->IncludeComponent(
							"bitrix:search.title",
							"srch-title",
							Array(
								"CATEGORY_0" => array("iblock_catalog","iblock_offers"),
								"CATEGORY_0_TITLE" => "",
								"CATEGORY_0_iblock_catalog" => array("all"),
								"CATEGORY_0_iblock_offers" => array("all"),
								"CHECK_DATES" => "N",
								"CONTAINER_ID" => "title-search",
								"CONVERT_CURRENCY" => "N",
								"INPUT_ID" => "title-search-input",
								"NUM_CATEGORIES" => "1",
								"ORDER" => "date",
								"PAGE" => "#SITE_DIR#catalog/search.php",
								"PREVIEW_TRUNCATE_LEN" => "",
								"PRICE_CODE" => array("BASE"),
								"PRICE_VAT_INCLUDE" => "N",
								"SHOW_INPUT" => "Y",
								"SHOW_OTHERS" => "N",
								"SHOW_PREVIEW" => "N",
								"TOP_COUNT" => "5",
								"USE_LANGUAGE_GUESS" => "Y"
							)
						);?>
					</div>
					<a href="/catalog/compare.php" class="header_item header_comparison">
						<?if($compareCount > 0) {?>
							<span class="header_item_icon" style="background-color: #fc6419;">
								<i class="svg-list" style="color: white;"></i>
							</span>
						<?} else {?>
							<span class="header_item_icon">
								<i class="svg-list"></i>
							</span>
						<?}?>
						
						<span class="header_item_content">
							<span>В сравнении:</span>
							<strong><?=$compareCount?> товар(ов).</strong>
						</span>
					</a>

					<a class="fancymodal2 header_item header_basket active" data-src="<?echo $basket['QUANTITY'] > 0 ? '/personal/order/make/?use_ajax=y' : '/personal/cart/?use_ajax=y'?>" data-fancybox="" data-type="ajax">
						<?if($basket['QUANTITY'] > 0) {?>
							<span class="header_item_icon" >
								<i class="svg-basket"></i>
							</span>
						<?} else {?>
							<span class="header_item_icon" style="background-color: transparent; border: 1px solid #fc6419">
								<i class="svg-basket" style="color: #fc6419"></i>
							</span>
						<?}?>

						<span class="header_item_content">
							<?if($basket['QUANTITY'] > 0){?>
								<span><?=$basket['QUANTITY']?> товар(ов):</span>
								<strong><?=CurrencyFormat($basket['PRICE'], 'UAH')?></strong>
							<?} else{?>
									<span>Корзина пустая</span>
							<?}?>
						</span>
						
					</a>
				</div>
			</div>
		</div>
	</div>
	<?
	
	if($_REQUEST['ajax']!='y') {
		$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"custom_menu",
			array(
				"ALLOW_MULTI_SELECT" => "N",
				"CHILD_MENU_TYPE" => "left",
				"COMPONENT_TEMPLATE" => "custom_menu",
				"DELAY" => "N",
				"MAX_LEVEL" => "2",
				"MENU_CACHE_GET_VARS" => array(),
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_TYPE" => "Y",
				"MENU_CACHE_USE_GROUPS" => "N",
				"ROOT_MENU_TYPE" => "top",
				"USE_EXT" => "Y"
			),
			false
		);
	}
	
	if ($APPLICATION->GetCurDir() != '/') { ?>
		<div class="container">
			<?
				$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"custom_bc",
					array(
						"PATH" => "",
						"SITE_ID" => "s1",
						"START_FROM" => "0",
						"COMPONENT_TEMPLATE" => "custom_bc"
					),
					false
				);
			?>

			<h1 class="h-title"><?$APPLICATION->ShowTitle();?></h1>
		</div>
	<? } ?>