<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "отзывы,товары, для вас");
$APPLICATION->SetPageProperty("title", "Отзывы о магазине | Магазин товары для вас");
$APPLICATION->SetPageProperty("description", "Здесь можно оставить отзыв о нашем магазине");
$APPLICATION->SetTitle("Отзывы о магазине");
?><script src='https://www.google.com/recaptcha/api.js'></script> <!-- Вывод компонента --> <?$APPLICATION->IncludeComponent(
	"custom",
	"",
	Array(
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "Y",
		"DETAIL_FIELD_CODE" => array("",""),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array("",""),
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"GROUP_PERMISSIONS" => array(),
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "simple",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array("",""),
		"LIST_PROPERTY_CODE" => array("",""),
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Отзывы",
		"SEF_FOLDER" => "",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("detail"=>"#ELEMENT_ID#/","news"=>"","section"=>""),
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHARE_HANDLERS" => array("lj"),
		"SHARE_HIDE" => "N",
		"SHARE_SHORTEN_URL_KEY" => "",
		"SHARE_SHORTEN_URL_LOGIN" => "",
		"SHARE_TEMPLATE" => "",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N"
	)
);?> <!-- Форма для ввода отзывов -->
<form action="" method="post" enctype="multipart/form-data" class="form-rew">
 <input type="text" placeholder="Введите ваше имя" name="NAME" class="text"> <input type="text" placeholder="Введите ваш электронный адрес" name="EMAIL" class="text"><br>
 <br>
 <input type="text" placeholder="Введите ваш телефон" name="PHONE" class="text"> <textarea placeholder="Введите ваш отзыв" name="REVIEWS" class="text-mess"></textarea><br>
 <input type="submit" class="submit" value="Отправить" name="OK">
	<div class="g-recaptcha" data-sitekey="6LcELlYUAAAAABk-UEapk1w8cwg4NU-mcyvEpdgM">
	</div>
</form>
 <?php
if (isset($_POST['submit'])) {
	$secret = '6LcELlYUAAAAAAdcKrHIcihM9YFWRG1sIUYWe5fN';
	$response = $_POST['g-recaptcha-response'];
	$remoteip = $_SERVER['REMOTE_ADDR'];

	$url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?=$secret&response=$response&remoteip=$remoteip");
	// Распечатывая функцию выше получаем джейсон объект, ниже будет декодирование данного значения в php
	$result = json_decode($url,TRUE); // Преобразуем js объект в массив и проверяем возвращаемый функцией succes
	//$print ($url);
	
	if ($result['succes'] == 1){
		echo $_POST['NAME'];
	}
}
?> <?
if($_POST["OK"]){
	if(CModule::IncludeModule("iblock")){	
		if($_POST["NAME"]!="" && $_POST["EMAIL"]!="" && $_POST["REVIEWS"]!="" && $_POST["PHONE"]!=""){
			echo "Спасибо, Ваше сообщение отправлено! В ближайшее время его проверят";
			$el = new CIBlockElement;
			$arLoadProductArray = Array(
			  "MODIFIED_BY"    => $USER->GetID(),
			  "IBLOCK_SECTION_ID" => false,
			  "IBLOCK_ID"      => 4,
			  "NAME"           => $_POST["NAME"],
			  "ACTIVE"         => "N",
			  "PREVIEW_TEXT"   => $_POST["REVIEWS"],
			  "DETAIL_TEXT"    => "E-Mail: " . $_POST["EMAIL"] . "\nТелефон: " . $_POST["PHONE"],
			  "PREVIEW_PICTURE" => CFile::MakeFileArray($fileID)
			  );
			if($PRODUCT_ID = $el->Add($arLoadProductArray))
			  echo "";
			else
			  echo "";   
		}else{
			echo "Заполнены не все поля";
		}
	}
}
?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>