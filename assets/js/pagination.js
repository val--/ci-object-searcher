// Fonction inspirée par celle de http://www.devandclick.fr/
// A faire : "disabled" sur la page en cours

function pagination(nbParPage, divSelect,divPager)
{	
    //Initialisation
    var nbElem = $(divSelect).length;
    var nbPage = Math.ceil(nbElem / nbParPage);
    var pageLoad = 1;
    
    $(divSelect).each(function(index) {
        if (index < nbParPage)
            $(divSelect).eq(index).show();
        else
            $(divSelect).eq(index).hide();
    });
    
    //Reset & verification
    function reset() {
        if (nbPage < 2) $(divPager).hide();
        $(divPager + ' ul li').removeClass('selected');
        $(divPager + ' ul li').eq(pageLoad -1).addClass('selected');
    }
    
    //Pagination generation
    $(divPager).html('<ul class="pagination"></ul>');
    for(i = 1; i <= nbPage; i++) $(divPager + ' ul').append('<li><a>' + i + '</a></li>');

    $(divPager + ' ul li').click(function() {
        if ($(this).index() + 1 != pageLoad) {
            pageLoad = $(this).index() + 1;
            $(divSelect).hide();
            
            $(divSelect).each(function(i) {
                if (i >= ((pageLoad * nbParPage) - nbParPage) && i < (pageLoad * nbParPage)) $(this).show();
            });
            
            reset();
        }
    });

    reset();
}