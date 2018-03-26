<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Test title");
?>

<!--BoltovIgnat start-->
<?$APPLICATION->IncludeComponent(
	"boltovignat:list", 
	".default", 
	array(),
	null
);?>
<!--BoltovIgnat end-->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>