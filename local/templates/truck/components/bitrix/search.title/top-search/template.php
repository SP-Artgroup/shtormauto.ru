<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

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

$this->setFrameMode(true);

$INPUT_ID = trim($arParams["~INPUT_ID"]);

if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";

$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);

if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";

$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

$placeholder = !empty($arParams['INPUT_PLACEHOLDER'])
	? $arParams['INPUT_PLACEHOLDER']
	: '';

if ($arParams["SHOW_INPUT"] !== "N"): ?>

	<div class="search-input-box" id="<?= $CONTAINER_ID ?>">

		<form action="<?= $arResult["FORM_ACTION"] ?>">
			<input
				class="search-input"
				id="<?= $INPUT_ID ?>"
				type="search"
				name="q"
				value=""
				size="40"
				maxlength="50"
				autocomplete="off"
				placeholder="<?= $placeholder ?>"
			>

			<button class="find-btn" type="submit">
				<i class="fas fa-search"></i>
			</button>
		</form>

	</div>

<? endif ?>

<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?= CUtil::JSEscape(POST_FORM_ACTION_URI) ?>',
			'CONTAINER_ID': '<?= $CONTAINER_ID ?>',
			'INPUT_ID': '<?= $INPUT_ID ?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>
