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
                switch(true)
                {
                    case (self.originalWidth < 768):
                        new_m = '160';
                    break;
                    default:
                        new_m = '280';
                    break;
                }

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

        jQuery(window).on('orientationchange', function () {
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
        if (self.sidebar.hasClass('open')) self.sidebar.css({marginLeft: '0'});

        self.width = jQuery(window).width();

        switch (true)
        {
            case (self.width < 768 && self.width > 400):
                self.sidebar.css({width: '160px'});
                self.mainView.css({marginLeft: '160px'});
            break;
            case (self.width < 768 && self.width < 400):
                self.sidebar.css({width: '120px'});
                self.mainView.css({marginLeft: '120px'});
            break;
            default:
                self.sidebar.css({width: '280px'});
                self.mainView.css({marginLeft: '280px'});
            break;
        }

        /*

        if (self.width < 780) {
            self.sidebar.css({display: 'none'});
            self.mainView.addClass('open');

            console.log('HIDE NAV');
            self.mainView.css({marginLeft: '0px'});
        }
        else {
            self.sidebar.css({display: 'block'});

            self.mainView.removeClass('open');
            self.mainView.css({marginLeft: '160px'});
        }

        */
    };
};

jQuery(document).ready(function () {
    var App = new BrandApp();
    App.init();
});
