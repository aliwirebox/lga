$(document).ready(syncHeights());

function syncHeights()
{
    if ($(window).width() < 768) return;

    var itemHeights = [],
        itemOuterHeights = [],
        imageHeights = [];

    $('.how-works-inner').each(function(element){
        itemHeights.push($(this).height());
    });

    $('.how-works-item').each(function(element){
        itemOuterHeights.push($(this).outerHeight());
    });

    $('.how-works-inner .how-works-icon').each(function(element){
        imageHeights.push($(this).height());
    });
    
    var maxOuterHeight = Math.max.apply(Math, itemOuterHeights),
        maxItemHeight  = Math.max.apply(Math, itemHeights),
        maxImageHeight = Math.max.apply(Math, imageHeights);

    $('.how-works-item').css('min-height', maxOuterHeight + 'px');
    $('.how-works-inner').css('min-height', maxOuterHeight + 'px');
    $('.how-works-inner .how-works-icon').css('min-height', maxImageHeight + 'px');

}

$(window).resize(syncHeights);

syncHeights();
