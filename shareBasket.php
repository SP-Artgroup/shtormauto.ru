<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
						$APPLICATION->SetTitle("");
						$id=(!empty($_REQUEST["id"]))?(int)$_REQUEST["id"]:0;
						?>
						<?$APPLICATION->IncludeComponent(
							"skyweb24:sharebasket.show",
							".default",
							array(
								"BASKET" => $id,
								"COMPONENT_TEMPLATE" => ".default",
							),
							false
						);
						?>
						<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
            