BrandApp = function () {
    var self = this;

    self.mainView = jQuery('.main-view');
    self.sidebar = jQuery('.brand-sidebar.backend');
    self.width = 0;

    self.init = function () {
        self.originalWidth = jQuery(window).width();

        jQuery('.close-sidebar').click(function (e) {
            e.preventDefault();
            var new_m;


            if (self.mainView.hasClass('open')) {
                new_m = '280';

                self.mainView.removeClass('open');
            } else {
                new_m = '0';

                self.mainView.addClass('open');
            }

            self.mainView.animate({marginLeft: new_m}, 350).show();

            jQuery('aside').animate({width: 'toggle'}, 350);
        });

        self.checkSidebar();

        jQuery(window).on('resize', function () {
            if (self.originalWidth !== self.width) {
                self.checkSidebar();
            }
        });


        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    };

    self.checkSidebar = function () {
        self.width = jQuery(window).width();

        if (self.width < 780) {
            self.sidebar.css({display: 'none'});
            self.mainView.addClass('open');

            console.log('HIDE NAV')
            self.mainView.css({marginLeft: '0px'});
        }
        else {
            self.sidebar.css({display: 'block'});
            self.sidebar.css({width: '280px'});

            self.mainView.removeClass('open');
            self.mainView.css({marginLeft: '280px'});
        }
    };
};

jQuery(document).ready(function () {
    var App = new BrandApp();
    App.init();
});
