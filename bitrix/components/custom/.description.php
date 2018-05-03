<?
// Проверка на подключение к ядру CMS
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("IBLOCK_NAME"), // Имя компонента через языковую переменную
	"DESCRIPTION" => GetMessage("IBLOCK_DESCRIPTION"), // Его описание
	"ICON" => "/images/otzyvy.gif", // Путь к иконке
	"PATH" => array( // Переменная задаёт...
		"ID" => GetMessage("CATEGORY_IBLOCK_DESCRIPTION"), //ID элемента для адмнистративной панели
		"CHILD" => array( // А для потомка...
			"ID" => GetMessage("DETAILS_IBLOCK_NAME"), //также ID
			"SORT" => 10, // И сортировку элемента
			),
		),
	);
?>