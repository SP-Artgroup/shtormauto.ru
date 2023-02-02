<?

header("Content-Type: application/x-javascript");

$settings = array(
    "buttons" => array(
        "default_back_button" => "back",
        "type" => array(
            "menu_icon_back" => "/mobile_app/images/main_top_owl.png",
            "cart_icon" => "/mobile_app/images/cart_icon.png",
            "closewhite_icon" => "/mobile_app/images/close_white.png"
        )
    ),
    "controller_settings" => array(
        "main_background" => array(
            "color" => "#FFFFFF"// цвет фона, имеет приоритет перед image
        ),
        "navigation_bar_color" => "#000",
        "navigation_bar_image" => "/mobile_app/images/navbar.png",
        "navigation_bar_image_large" => "/mobile_app/images/navbar.png",

        "toolbar_bar_image" => "/mobile_app/images/panel.png", //фон тулбара ios
        "toolbar_bar_image_large" => "/mobile_app/images/panel.png", //фон тулбара для планшетов ios
    ),
    "table" => array(
        "background_cell_image" => "/mobile_app/images/a_panel.png", //фон ячейки списка
        "row_height" => "150.0", //высота ячейки
        "row_height_large" => "63.0"//высота ячейки планшетная
    ),
    "pull_down" => array(
        "icon" => "/mobile_app/images/down_arrow.png", //стрелочка для пулдауна
        "text_color" => "#FFFFF", //цвет текста пулдауна
        "background" => array("color" => "#474747"),
    ),
    "additional" => array("use_top_bar" => "NO")
);
echo json_encode($settings);
?>
