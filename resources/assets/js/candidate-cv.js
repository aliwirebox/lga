Dropzone.autoDiscover = false;

jQuery(document).ready(function () {
    var nextButton = jQuery("#next-button"),
        cvSelectButton = jQuery('#cv-select-button');

    var files = [],
        cvDropzone = jQuery("#cv-dropzone").dropzone({
//            forceFallback: true, //helps test IE 9 fallback
            fallback: function() {
                jQuery("#cv-select-button").hide();
                jQuery("#profile-button-container").hide();
            },
            dictDefaultMessage: '',
            dictInvalidFileType: 'File type is incompatible. Please overwrite this file with a .doc or .pdf file',
            clickable: ['#cv-select-button'],
            paramName: "cv",
            maxFilesize: 20,
            acceptedFiles: '.pdf,.doc,.docx',
            url: "/candidate/profile/cv",
            success: function (file) {
                nextButton.removeClass('disabled');
            },
            init: function () {
                if (typeof existingCv !== 'undefined' && existingCv) {
                    this.emit("addedfile", existingCv);
                    this.emit("complete", existingCv);

                    files.push(existingCv);
                }

                this.on('success', function (file) {
                    files.push(file);

                    for (var i = 0; i < files.length; i++) {
                        if (files[i] !== file) {
                            if (files[i]) {
                                jQuery(files[i].previewElement).hide();
                            }
                        }
                    }
                });
            }
        });

    cvSelectButton.click(function (e) {
        e.preventDefault();
    });
});
