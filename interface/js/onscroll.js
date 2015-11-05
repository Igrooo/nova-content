$(document).ready(function() {

    header = $('header');
    explorerheader = $('#explorer-header');
    explorer = $('#explorer-header, #explorer-body');
	// Calcul de la marge entre le haut du document et #explorer-header
    fixedLimit = explorerheader.offset().top;
    function onscroll (fixedLimit){
        // Valeur de defilement
        windowScroll = $(window).scrollTop();
        
        if (windowScroll >= fixedLimit){
            header.height('5').addClass('reduce');
            explorer.addClass('top');
        }
        else if (windowScroll >= fixedLimit-20){
            header.height('10').addClass('reduce');
            explorer.removeClass('top');
        }
        else if (windowScroll >= fixedLimit-30){
            header.height('15').addClass('reduce');
            explorer.removeClass('top');
        }
        else if (windowScroll >= fixedLimit-40){
            header.height('20').addClass('reduce');
            explorer.removeClass('top');
        }
        else if (windowScroll >= fixedLimit-50){
            header.height('25').addClass('reduce');
            explorer.removeClass('top');
        }
        
        else{
            header.height('auto').removeClass('reduce');
            explorer.removeClass('top');
        }
    }
    
    $(window).scroll(function(event){
        onscroll(fixedLimit);
    });
    
    onscroll(fixedLimit);
    
});