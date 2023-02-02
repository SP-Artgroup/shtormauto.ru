<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->createFrame()->begin("Загрузка");?>

<?
if($arParams["SHOW_DIALOG"] && !$_COOKIE["geo_ip_city"])
{
    //Если не выбран город - надо спросить пользователя
    ?>
    <div id="choose-city-block">
        <div class="choose-city-form">	
            <div class="choose-city-caption">Местоположение</div>
            <div class="choose-city-guess">Ваш город <?=$_SESSION["CITY"]["NAME"]?>?</div>
            <a class="choose-city-yes adpt-btn-red" href="<?=$APPLICATION->GetCurPageParam("chcity=".$_SESSION["CITY"]["ID"]."&city_changed=1",array("chcity"))?>">Да</a>
            <a class="choose-city-another" href="/mobile_app/change_city.php">Выбрать другой город</a>
        </div>
    </div>
    <?
}
?>