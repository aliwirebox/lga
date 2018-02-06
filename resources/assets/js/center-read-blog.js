$(document).ready(centerItem('.text-wrapper'));

function centerItem(elem, removeStyle = false)
{
    this.centeredItem = $(elem);

    if ( removeStyle ) this.centeredItem.removeAttr('style');

    if ( !$(this.centeredItem).length || ( $(window).width() < 1200 ) ) return;

    this.init = function()
    {
        var containerHeight = this.centeredItem.parents(".row").css("height");
        $(this.centeredItem).css({
            marginTop: "calc(" + containerHeight + " / 3)"
        });
    };

    this.init();

}

$(window).resize(function()
{
    $(window).width() < 1200 ? centerItem('.text-wrapper', true) : centerItem('.text-wrapper');
});
