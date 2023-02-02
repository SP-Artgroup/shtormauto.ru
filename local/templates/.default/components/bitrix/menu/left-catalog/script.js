$(document).ready(function(){
    $(".root-item-parent").click(function(){
        $($(this)).addClass("selected");
        $("ul.child", $(this).parent()).slideToggle(500, function(){
            if($(this).is(":hidden")){
                $(".root-item", $(this).parent()).removeClass("selected");
            }
        });
        return false;
    });
});