(function (jQuery) {
    /**
     * Item Modal
     * @param element
     */
    jQuery.saveModal = function (element) {
        var self = this;

        /**
         * Element
         */
        self.element = jQuery(element);

        /**
         * The max input value for the name
         * @type {number}
         */
        self.maxCount = 50;

        /**
         * Initialise the plugin
         */
        self.init = function () {
            self.modal = jQuery('.save-modal');
            self.id = self.element.data('id');

            self.setCount(self.maxCount);

            self.bindEvents();
        };

        /**
         * Set the count
         * @param count
         */
        self.setCount = function (count) {
            self.modal.find('.count').text(count);
            self.input = self.modal.find('.name-input');
        };

        /**
         * Bind all events
         */
        self.bindEvents = function () {
            self.bindEvent(self.element, 'click', self.openModal);

            self.bindEvent(self.input, 'keyup', self.limitInputLength);

            self.bindEvent(self.modal.find('form'), 'submit', function (e) {
                e.preventDefault();
                var name = self.input.val();

                jQuery.post(jQuery(this).attr('action'), {
                    name: name,
                    id: self.id,
                    _token: self.modal.find('input[name="_token"]').val()
                }, function (res) {
                    self.modal.modal('hide');
                    self.element.hide();
                    jQuery('#search-name').text('Saved Search: ' + name);
                });
            });
        };

        /**
         * Limit the input length
         */
        self.limitInputLength = function () {
            var text = jQuery(this).val(),
                count = text.length,
                currentCount = (self.maxCount - text.length);

            if (count <= self.maxCount) {
                self.setCount(currentCount)
            }
            else {
                jQuery(this).val(text.substring(0, self.maxCount));
            }
        };

        /**
         * Open the modal
         */
        self.openModal = function () {
            self.modal.modal();
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
    jQuery.fn.saveModal = function (options) {
        //Loop through all the jQuery elements matched and attach an instance of the plugin
        return this.each(function () {
            (new jQuery.saveModal(this, options));
        });
    };
})(jQuery);

jQuery(document).ready(function () {
    jQuery('.save-modal-button').saveModal();
});
