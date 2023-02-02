$(function(){
    if($(document).has(".product-container").length===0){
        console.log("no");
        $(".no-element").toggle();
    }else{
        console.log("yes");
        $(".catalog-sort").toggle();
        
        $(".sidebar").addClass("hidden_catalog");
    };

    
});