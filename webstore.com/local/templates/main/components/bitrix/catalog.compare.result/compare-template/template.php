<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */



foreach($arResult['ITEMS'] as $id => $arItem){
	foreach($arItem['DISPLAY_PROPERTIES'] as $propName => $arProp){
		if( ($arProp['PROPERTY_TYPE'] == "S") && (!is_array($arProp['VALUE'])) ){
			$arItems[$arProp['NAME']][] = $arProp['DISPLAY_VALUE'];
		}
	}	
	foreach($arItem['OFFER_DISPLAY_PROPERTIES'] as $propName => $arOfferProp){
		if( ($arProp['PROPERTY_TYPE'] == "S") && (!is_array($arProp['VALUE'])) ){
			$arItems[$arOfferProp['NAME']][] = $arOfferProp['VALUE'];
		}
	}

}

?>

<div class="comparison clearfix">
	<div class="container">
		<div class="comparison_wrapper">
			<h1>Сравнение товаров</h1>
			<a href="#" class="reset_search">
				Очистить поиск
				<span class="product_item_discount">X</span>
			</a>
		</div>
	</div>
</div>

<div class="container">
	<div class="slide-auto comparison">

		<!-- MAIN LEFT ITEM -->
		<div class="slide-left">
			<div class="product_item_first clearfix">
				<a href="#" class="product_item_img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/comparison.jpg" alt="product img"></a>
				<a href="#" class="add_model product_item_title">Добавить<br> еще 1 модель</a>
				<div class="cart_tabs">
					<div class="cart_tabs_nav">
						<a class="compare_link compare_all" href="?DIFFERENT=N" data-tabs="1" class="active">Все<br> характеристики</a>
						<a class="compare_link compare_different" href="?DIFFERENT=Y" data-tabs="2">Только отличия</a>
					</div>
					<div class="cart_content">
						<div class="cart_tabs_content">

							<!-- FIRST TAB -->
							<div class="cart_tabs_item active" data-tabs="1">

								<?foreach($arItems as $name => $arItem){?>
									<div class="cart_characteristics_item">
										<div class="cart_characteristics_left equally prop1"><?=$name?>
											<i class="svg-question">
												<span>
													<img class="callout" src="<?= SITE_TEMPLATE_PATH ?>/img/callout2.png" />
													<?="EMPTY"?>
												</span>
											</i>
										</div>
									</div>
								<?}?>

							</div>

							<!-- SECOND TAB -->

							<?
								if($_REQUEST['DIFFERENT'] == "Y") {

									foreach($arItems as $name => $arItem){
										$return = 0;
										for($i = 0; $i < count($arItem); $i++){
									
											if($arItem[$i] == $arItem[$i+1]){
												$return++;
											}	
										}
										if($return == count($arItem) - 1){
											unset($arItems[$name]);
										}
									}
								}
							?>

							<div class="cart_tabs_item tabs2" data-tabs="2">

								<?foreach($arItems as $name => $arItem){?>
									<div class="cart_characteristics_item">
										<div class="cart_characteristics_left equally prop1"><?=$name?>
											<i class="svg-question">
												<span>
													<img class="callout" src="<?= SITE_TEMPLATE_PATH ?>/img/callout2.png" />
													<?="DESCRIPTION"?>
												</span>
											</i>
										</div>
									</div>
								<?}?>

							</div>

						</div>
					</div>
				</div>

			</div>
		</div>

		<!-- RIGHT ELEMENTS -->

		<div class="slide">
			<div class="slide_wrapper">

				<!-- Кількість елементів - 5 -->
				<?$itemCnt = 0?>
				<?foreach($arResult['ITEMS'] as $item){?> 



					<div class="product_item">
						<!-- CANCEL -->
						<a href='<?=$item['~DELETE_URL']?>' class="product_item_discount"><i class="svg-cancel"></i></a>

						<!-- PRODUCT INFO -->
						<a href="#" class="product_item_img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/product_item_1.jpg" alt="product img"></a>
						<a href="#" class="product_item_title"><?=$item['NAME'] . " " . $item['OFFER_PROPERTIES']['SIZE']['VALUE']?></a>
						<div class="product_item_price"><?=$item['MIN_PRICE']['PRINT_VALUE']?></div>

						<!-- ADD2BASKET BUTTON -->
						<div class="product_item_bottom">
							<a href="#" class="btn product_item_btn"><i class="svg-basket"></i> В корзину</a>
						</div>

						<!-- PROPERTIES -->
						<ul class="product_deskr">
							<?foreach($arItems as $name => $arItem){?>
								<li class="equally"><?=$arItem[$itemCnt]?></li>
							<?}?>
						</ul>
					</div>

					<?$itemCnt++?>
				
				<?}?>

				

			</div>

		</div>
	</div>

</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	"feedback",
	Array(
		"EMAIL_TO" => "sale@webstore.com",
		"EVENT_MESSAGE_ID" => array(),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(),
		"USE_CAPTCHA" => "Y"
	)
);?>

<script>



</script>