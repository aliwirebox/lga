(function (jQuery) {
    'use strict';

    /**
     * Custom Select
     * @param options
     */
    jQuery.fn.customSelect = function (options) {
        var element = jQuery(this),
            self = this;

        // support multiple elements
        if (this.length > 1) {
            this.each(function () {
                jQuery(this).customSelect(options);
            });
            return this;
        }

        /**
         * Element
         */
        self.element = jQuery(element);

        /**
         * Array of UL's to append list items
         * @type {string}
         */
        self.listElements = [];

        /**
         * All selected options
         * @type {Array}
         */
        self.selectedOptions = [];

        /**
         * The modal
         * @type {string}
         */
        self.modal = '';

        /**
         * A flag to signify that the drop down is setting up. Primarily added to change the behavior
         * of setupChildren() to select all children after setup has finished. See line 209
         * @type {bool}
         */
        self.isInitialising = true;

        /**
         * Plugin options
         * @type {{list_template: string, modal_template: string, modal: boolean}}
         */
        self.options = {
            list_template: '<ul class="label-list"></ul>',
            group_template: '<div class="label-container"><h3 class="label-header" style="margin-bottom:0"></h3><span style="margin-bottom:10px"class="label-sub-text red m-left-10"></span></div>',
            modal_template: '<div class="modal alt-modal clone-select-modal" tabindex="-1" role="dialog">' +
            '<div class="modal-dialog modal-sm">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<a href="" data-dismiss="modal" class="close close-alt-modal" aria-label="Close"><i class="brand-sprite"></i></a>' +
            '<h4 class="modal-title"></h4>' +
            '<span class="fs-12">Select / Deselect specific practice areas. </span>' +
            '</div>' +
            '<div class="modal-body">' +
            '<div class="select-place"></div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>',
            modal: false,
            liveSearchStyle: 'startsWith'
        };

        self.elementsToDestroy = [];

        /**
         * Initialise the plugin
         */
        self.init = function () {
            //Merge any custom options with the default options. Custom take precedence
            self.options = jQuery.extend(self.options, options);

            //Create list elements
            self.setupList();

            //Bind initial events
            self.bindEvents();

            if (self.options.modal) {
                self.setupModal();
            }
            else {
                var numberOfOptions = self.element.find('option').length;

                self.dropdown = self.element.selectpicker({
                    liveSearch: numberOfOptions >= 20,
                    liveSearchStyle: self.options.liveSearchStyle,
                    header: '<span>Close</span>', //header has to have title so I have hidden it in css
                    showTick: true
                });

                var title = self.dropdown.parent().find('.filter-option'),
                    newTitle = title.clone(title).text(self.element.data('title')).removeClass('filter-option');

                title.hide();
                title.after(newTitle);
            }

            //Run the update on any selected element
            self.update();

            self.isInitialising = false;

            return self;
        };

        /**
         * Setup modal if required
         */
        self.setupModal = function () {
            var modal = jQuery(self.options.modal_template);

            //Append the modal
            self.element.parent().append(modal);

            //Assign the modal
            self.modal = modal;

            //Set the title
            self.modal.find('.modal-title').text(self.element.parent().find('.tab-title').text());

            //Detach the element from the DOM
            self.element = self.element.detach();

            //Append the detached element into the modal
            self.modal.find('.select-place').append(self.element);

            //Add sepcial select picker
            self.modal.find('select').selectpicker({
                header: '<span>Close</span>', //header has to have title so I have hidden it in css
                showTick: true
            });
        };

        /**
         * Creates the list element, dealing with any option groups etc
         */
        self.setupList = function () {
            var optionGroups = self.element.find('optgroup');

            //Check if we need to deal with multiple listElements
            if (optionGroups.length > 0) {
                //Loop through any option groups
                optionGroups.each(function (index) {
                    //Get the option group title
                    var label = jQuery(this).attr('label'),
                        container = jQuery(self.options.group_template),
                        listElement = jQuery(self.options.list_template);

                    //Create the ul list
                    container.append(listElement);

                    //Append the container
                    self.element.parent().append(container);

                    //Push the new list element into the array of lists
                    self.listElements.push(listElement);

                    //Loop through all the option groups options and assign list index
                    jQuery(this).find('option').each(function () {
                        jQuery(this).data('listIndex', index);
                    });

                    //Create an element in the list for the header of the group
                    container.find('.label-header').text(label);

                    //temporary solution to add subtext to one of the label headers
                    if (label == 'Top Ranked for (London firms only):') {
                        container.find('.label-sub-text').html('Law firms included in ‘Top Ranked For’ are ranked by Legal 500 as either Tier 1 or Tier 2 for each practice area. For more information, please visit <a target="_blank" href="http://www.legal500.com/c/london">http://www.legal500.com/c/london</a>');
                    }

                    self.elementsToDestroy.push(container);

                });
            }
            else {
                var listElement = jQuery(self.options.list_template);

                //Create the ul list
                self.element.parent().append(listElement);

                //push the UL into the array
                self.listElements.push(listElement);

                //Loop through each option and give them the list element index
                //For no option groups it will always be 0
                self.element.find('option').each(function () {
                    jQuery(this).data('listIndex', 0);
                });

                //If the options sets modal, append the button
                if (self.options.modal) {
                    listElement.append('<li class="modal-button"><span class="open-modal-button btn btn-dark btn-xs tag_btn">Delete Specialism -</span></li>');
                }

                self.elementsToDestroy.push(listElement);
            }
        };

        self.setupChildren = function (option, li) {
            //Get the children attribute
            var children = jQuery(option).data('children');

            //Check if the option has children
            if (children && children.length > 0) {
                //Build a name based on the parent element
                var selectName = self.element.attr('name') + '[' + jQuery(option).val() + '][]',
                    //Find a select with the matching name
                    select = self.element.parent().find('select[name="' + selectName + '"]');

                //Check if the name does not exist
                if (select.length === 0) {
                    //Create the select
                    var selectElement = jQuery('<select multiple name="' + selectName + '" data-parent-id="' + jQuery(option).val() + '" class="child-select form-control"></select>');

                    var i;

                    //Loop through and append all the children to the new select
                    for (i = 0; i < children.length; i++) {
                        /*
                         * When initialising check child data to see what is selected.
                         * Else update is being fired from a change event which requires all children to be selected.
                         */
                        var selected = children[i].selected || !self.isInitialising ? 'selected' : '';

                        selectElement.append('<option ' + selected + ' value="' + children[i].id + '">' + children[i].name + '</option>');
                    }

                    selectElement.data('parentOption', option);

                    //Apparent select into li
                    select = li.append(selectElement);

                    //Init the self on the new select
                    selectElement.customSelect({
                        modal: true
                    });
                }
            }
        };

        /**
         * Bind all events
         */
        self.bindEvents = function () {
            //Bind the change event to the select input
            self.bindEvent(self.element, 'change', self.update);

            jQuery(self.listElements).each(function () {
                self.bindEvent(jQuery(this).find('.open-modal-button'), 'click', self.openModal);
            });
        };

        /**
         * Open the modal
         */
        self.openModal = function () {
            //Bind event for when modal has been shown. Hack timeout to 200 MS to show drop down
            self.modal.on('show.bs.modal', function () {
                //Such a hack
                setTimeout(function () {
                    self.modal.find('.child-select').addClass('open');
                }, 200);
            });

            self.modal.modal();
        };

        /**
         * Update inputs
         */
        self.update = function () {
            var addValues = self.element.find('option:selected'),
                removeValues = self.element.find('option:not(:selected)');

            if (self.options.modal && addValues.length == 0) {
                //Close the modal if open
                if (self.modal.hasClass('in')) {
                    self.modal.modal('toggle');
                }

                //If is a children option and none are selected, remove parent and break function
                self.element.data('parentOption').prop('selected', '').closest('select').change();

                return;
            }

            //When options are selected/unselected, remove/add options
            self.updateSelectedOptions(self.element, addValues, removeValues);

            self.trigger('customSelect:change');
        };

        /**
         * Bind an event
         * @param element Selector/jQuery object
         * @param event String event (click, change.. etc)
         * @param action
         */
        self.bindEvent = function (element, event, action) {
            //Binds an event to existing/non-existing elements
            jQuery(element).on(event, action);
        };

        /**
         * Loop through elements and checking if they're either any selected or have children
         *
         * @param element
         * @param anySelected
         * @returns {Array}
         */
        self.hasAnyChanges = function (element, anySelected) {
            //Children
            var children,
                //Array of changes
                changes = [];

            //Loop through each selected element and recheck
            element.each(function () {
                //Get the options children data tag
                children = jQuery(this).data('children');

                //Check if the current value is in the anySelected array
                //Or if the option has children
                if (anySelected.indexOf(jQuery(this).attr('value')) > -1 || (children && children.length > 0)) {
                    //Push the option element into the changes array
                    changes.push(jQuery(this));
                }
            });

            //Return the changes array
            return changes;
        };

        /**
         * Update selected options
         * @param element
         * @param addValues
         * @param removeValues
         */
        self.updateSelectedOptions = function (element, addValues, removeValues) {
            var hasAnySelected = self.checkIfHasAny(addValues),
                hasAnyChanges = self.hasAnyChanges(addValues, hasAnySelected);

            if ((hasAnyChanges && hasAnyChanges.length > 0) && addValues.length > 1 && hasAnySelected.length > 0) {
                //Uncheck all options ready for rechecking
                element.val([]);

                //Removes all unselected values from the array
                self.removeOptions(removeValues);

                //Recheck any/all option
                for (var i = 0; i < hasAnyChanges.length; i++) {
                    jQuery(hasAnyChanges[i]).prop('selected', true);
                }

                //Add all the options return from hasAnyChanges(Options that contain `any`, `all` or have children)
                self.addOptions(hasAnyChanges);

                //Remove tick icons from selectpicker
                self.element.selectpicker('render');
            }

            //Removes all unselected values from the array
            self.removeOptions(removeValues);

            //Adds all new elements to array
            self.addOptions(addValues);
        };

        /**
         * Checks if any is selected
         */
        self.checkIfHasAny = function (values) {
            var value, i, anyChosen = [], isAny, option;

            for (i = 0; i < values.length; i++) {
                //The option to inspect
                option = jQuery(values[i]);

                //The options value with whitespace trimmed
                value = option.text().toLowerCase().trim();

                //Whether the values name is == to any/all/all law firms
                isAny = (value == 'any' || value == 'all' || value == 'all law firms' || value == 'any uk university');

                if (isAny) {
                    anyChosen.push(option.attr('value'));
                }
            }

            return anyChosen;
        };

        /**
         * Loop through selected options and add if required
         * @param options
         */
        self.addOptions = function (options) {
            var i;
            //Loop through all the selected options and remove from the array
            for (i = 0; i < options.length; i++) {
                self.addOption(jQuery(options[i]));
            }
        };

        /**
         * Loop through and remove options if required
         * @param options
         */
        self.removeOptions = function (options) {
            var i;

            //Loop through all unselected options and remove from the array
            for (i = 0; i < options.length; i++) {
                self.removeOption(jQuery(options[i]));
            }
        };

        /**
         * Search the selected array for previous values
         * @param value
         * @param key
         * @param returnIndex Boolean, whether to return true/false or the index of the match
         */
        self.isSelected = function (value, key, returnIndex) {
            var i;

            //Loop through all selected options and check if the value matches any, if it does, its already selected.
            for (i = 0; i < self.selectedOptions.length; i++) {
                if (self.selectedOptions[i][key] == value) {
                    return returnIndex ? i : true;
                }
            }

            return false;
        };


        /**
         * Add an option to the array
         * @param element
         * @returns {boolean}
         */
        self.addOption = function (element) {
            var value = element.val(),
                text = element.text().replace(/\s\(All\)/, ''), //remove (All) if exists
                index = element.data('listIndex');

            //Check if the value is not already selected
            if (!self.isSelected(value, 'id') && !isNaN(index)) {
                //Push the new value into the array
                self.selectedOptions.push({
                    text: text,
                    id: value
                });

                //Append the element to the list
                var li = jQuery('<li class="selected-list-item" data-value="' + value + '">' +
                    '<span class="tab-title label label-danger p-5 parent ' + (self.options.modal ? ' label-outline ' : '') + '">' + text + '' +
                    '<i class="brand-sprite brand-close"></i>' +
                    '</span>' +
                    '</li>');

                //Create the children select box if it has children
                self.setupChildren(element, li);

                //Find the list by the index and append the li
                self.listElements[index].prepend(li);

                //Bind the event to remove tag clicked
                self.bindEvent(li.find('.tab-title'), 'click', function () {
                    //Remove the option by value
                    self.removeOption(self.element.find('option[value="' + jQuery(this).parent().data('value') + '"]'));
                    self.update();
                });
            }
        };

        /**
         * Remove an option by ID
         * @param element
         * @returns {boolean}
         */
        self.removeOption = function (element) {
            var id = element.val(),
                index = parseInt(self.isSelected(id, 'id', true));

            //Check if an integer is returned from isSelected(), if it is, its an index
            if (!isNaN(index)) {
                //Remove element from array
                self.selectedOptions.splice(index, 1);

                //Remove list item from DOM
                self.listElements[element.data('listIndex')].find('li[data-value="' + id + '"]').remove();

                //Update select property and set to false

                self.element.find('option[value="' + id + '"]').prop('selected', false);

                self.element.selectpicker('render');
            }
        };

        /**
         *  Destroy the plugin
         *
         */
        self.destroy = function () {
            //Destroy the selectpicker instance
            self.element.selectpicker('destroy');
            self.element.unbind();
            self.elementsToDestroy.concat(self.listElements);

            for (var i = 0; i < self.elementsToDestroy.length; i++) {
                self.elementsToDestroy[i].remove();
            }

            return self;
        };

        /**
         * Public Function definitions
         */
        jQuery.fn.customSelect.destroy = self.destroy;

        //Boot the plugin
        return self.init();
    };
})(jQuery);
