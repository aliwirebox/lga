$(document).ready(centerItem('.text-wrapper'));

function centerItem(elem, removeStyle)
{
    if (typeof(removeStyle) === undefined) removeStyle = false;

    this.centeredItem = $(elem);

    if ( removeStyle )
    {
        this.centeredItem.removeAttr('style');
        this.centeredItem.addClass('m-top-30');
    };

    if ( !$(this.centeredItem).length || ( $(window).width() < 1200 ) ) return;

    this.init = function()
    {
        var containerHeight = this.centeredItem.parents(".row").css("height");
        if ( $(this.centeredItem).hasClass('m-top-30') ) $(this.centeredItem).removeClass('m-top-30');
        if ( $(window).width() >= 1600 )
        {
            $(this.centeredItem).css({
                marginTop: "calc(" + containerHeight + " / 2)",
                right: "35%",
                width: "400px"
            });
        }
        else 
        {
            $(this.centeredItem).css({
                marginTop: "calc(" + containerHeight + " / 3)",
            });
        }
    };

    this.init();

}

$(window).resize(function()
{
    $(window).width() < 1200 ? centerItem('.text-wrapper', true) : centerItem('.text-wrapper', false);
});
