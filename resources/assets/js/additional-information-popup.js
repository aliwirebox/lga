(function (jQuery) {
    /**
     * Item Modal
     * @param element
     */
    jQuery.additionalInformationModal = function (element) {
        var self = this;

        /**
         * Element
         */
        self.element = jQuery(element);

        /**
         * Modal Title
         * @type {string}
         */
        self.title = '';


        /**
         * Initialise the plugin
         */
        self.init = function () {
            self.title = self.element.data('title');
            self.information = self.element.data('information');
            self.templateSelector = self.element.data('template');
            self.templateHtml = jQuery(self.templateSelector).html();

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
                information: self.information
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
    jQuery.fn.additionalInformationModal = function (options) {
        //Loop through all the jQuery elements matched and attach an instance of the plugin
        return this.each(function () {
            (new jQuery.additionalInformationModal(this, options));
        });
    };
})(jQuery);

jQuery(document).ready(function () {
    jQuery('.match-additional-information').additionalInformationModal();
});