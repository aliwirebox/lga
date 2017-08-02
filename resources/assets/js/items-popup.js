(function (jQuery) {
    /**
     * Item Modal
     * @param element
     */
    jQuery.itemsModal = function (element) {
        var self = this;

        /**
         * Element
         */
        self.element = jQuery(element);

        /**
         * List items
         * @type {Array}
         */
        self.data = [];

        /**
         * Modal Title
         * @type {string}
         */
        self.title = '';


        /**
         * Initialise the plugin
         */
        self.init = function () {
            self.data = self.element.data('items');
            self.title = self.element.data('title');
            self.templateSelector = self.element.data('template');
            self.templateHtml = jQuery(self.templateSelector).html();
            
            //If the data attribute doesn't contain an array, exit
            if (!self.isObject(self.data)) {
                self.data = jQuery.parseJSON(self.data);

                if (!self.isObject(self.data)) {
                    return;
                }
            }

            self.bindEvents();
        };

        /**
         * Check if object
         * @returns {boolean}
         */
        self.isObject = function (data) {
            return (typeof data == 'object');
        };

        /**
         * Bind all events
         */
        self.bindEvents = function () {
            self.bindEvent(self.element, 'click', self.openModal);
        };

        /**
         * Open the modal
         */
        self.openModal = function () {
            var html = self.renderTemplate();

            jQuery(html({
                title: self.title,
                data: self.data
            })).modal();
        };

        /**
         * Render modal template
         * @returns {*}
         */
        self.renderTemplate = function () {
            return Handlebars.compile(self.templateHtml);
        };

        /**
         * Bind an event
         * @param element
         * @param event
         * @param fn
         */
        self.bindEvent = function (element, event, fn) {
            element.on(event, fn);
        };

        //Boot the plugin
        self.init();
    };

    /**
     * Extend jQuery
     * @param options
     * @returns {*}
     */
    jQuery.fn.itemsModal = function (options) {
        //Loop through all the jQuery elements matched and attach an instance of the plugin
        return this.each(function () {
            (new jQuery.itemsModal(this, options));
        });
    };
})(jQuery);

jQuery(document).ready(function () {
    jQuery('.items-modal').itemsModal();
});