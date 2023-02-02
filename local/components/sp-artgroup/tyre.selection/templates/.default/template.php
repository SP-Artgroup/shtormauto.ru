<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

?>

<input type="hidden" name="tyreOrWheel" value="<?= $arParams['TYRE_OR_WHEEL'] ?>">

<?

$field = 'VENDOR';
$ar    = $arResult['arDataForFormFields'][ $field ];
?>
<div class="form-group">
    <label class="form-label">Марка автомобиля:</label>
    <div class="form-select">
        <select name="<?= $field ?>">
            <option value="" disabled selected>Выберите марку автомобиля</option>
            <?foreach ($ar as $value): ?>
                <option <?= ($arResult['arFields'][ $field ] == $value) ? 'selected' : '' ?>><?= $value ?></option>
            <?endforeach ?>
        </select>
    </div>
</div>
<?

$field = 'MODEL';
$ar    = $arResult['arDataForFormFields'][ $field ];
$strHidden = ($ar) ? '' : 'hidden';
?>
<div class="form-group <?= $strHidden ?>">
    <label class="form-label">Модель:</label>
    <div class="form-select">
        <select name="<?= $field ?>">
            <option value="" disabled selected>Выберите модель</option>
            <?foreach ($ar as $value): ?>
                <option <?= ($arResult['arFields'][ $field ] == $value) ? 'selected' : '' ?>><?= $value ?></option>
            <?endforeach ?>
        </select>
    </div>
</div>
<?

$field     = 'YEAR';
$ar        = $arResult['arDataForFormFields'][ $field ];
$strHidden = ($ar) ? '' : 'hidden';
?>
<div class="form-group <?= $strHidden ?>">
    <label class="form-label">Год выпуска:</label>
    <div class="form-select">
        <select name="<?= $field ?>">
            <option value="" disabled selected>Выберите год выпуска</option>
            <?foreach ($ar as $value): ?>
                <option <?= ($arResult['arFields'][ $field ] == $value) ? 'selected' : '' ?>><?= $value ?></option>
            <?endforeach ?>
        </select>
    </div>
</div>
<?

$field     = 'MODIFICATION';
$ar        = $arResult['arDataForFormFields'][ $field ];
$strHidden = ($ar) ? '' : 'hidden';
?>
<div class="form-group <?= $strHidden ?>">
    <label class="form-label">Модификация:</label>
    <div class="form-select">
        <select name="<?= $field ?>">
            <option value="" disabled selected>Выберите модификацию</option>
            <?foreach ($ar as $value): ?>
                <option <?= ($arResult['arFields'][ $field ] == $value) ? 'selected' : '' ?>><?= $value ?></option>
            <?endforeach ?>
        </select>
    </div>
</div>

<script>
    if (document.sp_art == undefined) {
        document.sp_art = {};
    }
    document.sp_art.tyre_selection = {
        urlAjax: '<?= $component->getPath() . '/ajax.php' ?>'
    };
</script>
