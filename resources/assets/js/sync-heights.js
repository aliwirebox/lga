$(document).ready(syncHeights());

function syncHeights()
{
    if ($(window).width() < 768) return;

    var itemHeights = [],
        itemOuterHeights = [],
        textHeights = [];

    $('.how-works-inner').each(function(element){
        itemHeights.push($(this).height());
    });

    $('.how-works-item').each(function(element){
        itemOuterHeights.push($(this).outerHeight());
    });

    $('.how-works-inner .content').each(function(element){
        textHeights.push($(this).height());
    });
    
    var maxOuterHeight = Math.max.apply(Math, itemOuterHeights),
        maxItemHeight  = Math.max.apply(Math, itemHeights),
        maxTextHeight  = Math.max.apply(Math, textHeights);

    $('.how-works-item').css('min-height', maxOuterHeight + 'px');
    $('.how-works-inner').css('min-height', maxOuterHeight + 'px');
    $('.how-works-inner .content').css('min-height', maxTextHeight + 'px');

}

$(window).resize(syncHeights);

syncHeights();
