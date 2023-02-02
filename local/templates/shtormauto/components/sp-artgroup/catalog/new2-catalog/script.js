$(function(){
    if($(document).has(".product-container").length===0){
        $(".no-element").toggle();
    }else{
        $(".catalog-sort").toggle();
        $(".sidebar").addClass("hidden_catalog");
    };    
});