$(document).ready(scrollTaggedPosts());

function scrollTaggedPosts()
{
    var clicked = localStorage.getItem('buttonClicked');

    $('.tags a').click(function(){
        localStorage.setItem('buttonClicked', true);
    });

    if (clicked)
    {
        $('html, body').animate({
            scrollTop: $('.blog-listings').offset().top - 350
        }, 900, 'swing');
    }

    localStorage.removeItem('buttonClicked');
}
