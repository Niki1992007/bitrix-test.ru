<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "������,������, ��� ���");
$APPLICATION->SetPageProperty("title", "������ � �������� | ������� ������ ��� ���");
$APPLICATION->SetPageProperty("description", "����� ����� �������� ����� � ����� ��������");
$APPLICATION->SetTitle("������ � ��������");
?><script src='https://www.google.com/recaptcha/api.js'></script> <!-- ����� ���������� --> <?$APPLICATION->IncludeComponent(
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
		"DETAIL_PAGER_TITLE" => "��������",
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
		"PAGER_TITLE" => "������",
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
);?> <!-- ����� ��� ����� ������� -->
<form action="" method="post" enctype="multipart/form-data" class="form-rew">
 <input type="text" placeholder="������� ���� ���" name="NAME" class="text"> <input type="text" placeholder="������� ��� ����������� �����" name="EMAIL" class="text"><br>
 <br>
 <input type="text" placeholder="������� ��� �������" name="PHONE" class="text"> <textarea placeholder="������� ��� �����" name="REVIEWS" class="text-mess"></textarea><br>
 <input type="submit" class="submit" value="���������" name="OK">
	<div class="g-recaptcha" data-sitekey="6LcELlYUAAAAABk-UEapk1w8cwg4NU-mcyvEpdgM">
	</div>
</form>
 <?php
if (isset($_POST['submit'])) {
	$secret = '6LcELlYUAAAAAAdcKrHIcihM9YFWRG1sIUYWe5fN';
	$response = $_POST['g-recaptcha-response'];
	$remoteip = $_SERVER['REMOTE_ADDR'];

	$url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?=$secret&response=$response&remoteip=$remoteip");
	// ������������ ������� ���� �������� ������� ������, ���� ����� ������������� ������� �������� � php
	$result = json_decode($url,TRUE); // ����������� js ������ � ������ � ��������� ������������ �������� succes
	//$print ($url);
	
	if ($result['succes'] == 1){
		echo $_POST['NAME'];
	}
}
?> <?
if($_POST["OK"]){
	if(CModule::IncludeModule("iblock")){	
		if($_POST["NAME"]!="" && $_POST["EMAIL"]!="" && $_POST["REVIEWS"]!="" && $_POST["PHONE"]!=""){
			echo "�������, ���� ��������� ����������! � ��������� ����� ��� ��������";
			$el = new CIBlockElement;
			$arLoadProductArray = Array(
			  "MODIFIED_BY"    => $USER->GetID(),
			  "IBLOCK_SECTION_ID" => false,
			  "IBLOCK_ID"      => 4,
			  "NAME"           => $_POST["NAME"],
			  "ACTIVE"         => "N",
			  "PREVIEW_TEXT"   => $_POST["REVIEWS"],
			  "DETAIL_TEXT"    => "E-Mail: " . $_POST["EMAIL"] . "\n�������: " . $_POST["PHONE"],
			  "PREVIEW_PICTURE" => CFile::MakeFileArray($fileID)
			  );
			if($PRODUCT_ID = $el->Add($arLoadProductArray))
			  echo "";
			else
			  echo "";   
		}else{
			echo "��������� �� ��� ����";
		}
	}
}
?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>