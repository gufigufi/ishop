$(document).ready(function(){
    
    /* ===Аккордеон=== */
    var openItem = false;
	if(jQuery.cookie("openItem") && jQuery.cookie("openItem") != 'false'){
		openItem = parseInt(jQuery.cookie("openItem"));
	}	
	jQuery("#accordion").accordion({
		active: openItem,
		collapsible: true,
        autoHeight: false,
        header: 'h3'
	});
	jQuery("#accordion h3").click(function(){
		jQuery.cookie("openItem", jQuery("#accordion").accordion("option", "active"));
	});	
	jQuery("#accordion > li").click(function(){
		jQuery.cookie("openItem", null);
        var link = jQuery(this).find('a').attr('href');
        window.location = link;
	});
    /* ===Аккордеон=== */

    /* ===переключятель видов=== */
    if($.cookie("display") == null){
        $.cookie("display", "grid");
    }
    $(".grid-list").click(function(){
        var display = $(this).attr("id"); // получаем значение переключятеля вида
        display = (display == "grid") ? "grid" : "list"; // допустимые значения
        if(display == $.cookie["display"]){
            // если значение совподает с кукой - ничего не делаем
            return false
        }
        else{
            // иначе установим куку с новым значением вида
            $.cookie("display", display);
            window.location = "?" + query;
        }
        return false
    });
    /* ===переключятель видов=== */

});