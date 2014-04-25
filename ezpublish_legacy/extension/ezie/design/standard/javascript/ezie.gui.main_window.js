// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Image Editor extension for eZ Publish
// SOFTWARE RELEASE: 1.4.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2012 eZ Systems AS
// SOFTWARE LICENSE: eZ Business Use License Agreement eZ BUL Version 2.1
// NOTICE: >
//   This source file is part of the eZ Publish CMS and is
//   licensed under the terms and conditions of the eZ Business Use
//   License v2.1 (eZ BUL).
// 
//   A copy of the eZ BUL was included with the software. If the
//   license is missing, request a copy of the license via email
//   at license@ez.no or via postal mail at
//  	Attn: Licensing Dept. eZ Systems AS, Klostergata 30, N-3732 Skien, Norway
// 
//   IMPORTANT: THE SOFTWARE IS LICENSED, NOT SOLD. ADDITIONALLY, THE
//   SOFTWARE IS LICENSED "AS IS," WITHOUT ANY WARRANTIES WHATSOEVER.
//   READ THE eZ BUL BEFORE USING, INSTALLING OR MODIFYING THE SOFTWARE.

// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##

ezie.gui.main_window = function() {
    var jWindow = null;
    var initialized = false;

    // returns the jQuery Dom element corresponding to
    // the window
    var getJWindow = function() {
        return jWindow;
    };

    var setBinds = function () {
        $.each(ezie.gui.config.bindings.main_window, function() {
            var config = this;
            var item = $(config.selector);

            item.click(function () {
                config.click();
                return false;
            });

            if (item.prop('title').length > 0) {
                var p = item.closest('div.ezieBox').find('div.bottomBarContent p')
                var oldcontent = p.html()

                item.hover(function (){
                    p.html($(this).attr('title'))
                }, function () {
                    p.html(oldcontent)
                });
            }

        })

    };

    var freeze = function() {
        $("#grid span").freeze();
    }
    var unfreeze = function() {
        $("#grid span").unfreeze();
    }

    var init = function() {
        setBinds();
        jWindow = $("#ezieMainWindow");
    };

    var hide = function () {
        jWindow.fadeOut('fast');
    };

    var show = function () {
        if (!initialized) {
            init();

            initialized = true;
        }
        jWindow.fadeIn('fast');
    }

    var updateImage = function() {
        $.log('update main image');
        var currentImage = ezie.history().current();
        $.log('  main_image_url = ' + currentImage.image);
        if (currentImage) {
            img = $("<img></img>").attr("src", currentImage.image + "?" + currentImage.mixed)
            .attr("alt", "");
            jWindow.find("#main_image").html(img);
        }
        ezie.gui.config.zoom().reZoom();
    }

    var showLoading = function() {
        $("#loadingBar").fadeIn();
    };
    var hideLoading = function() {
        $("#loadingBar").fadeOut();
    }

    return {
        jWindow:getJWindow,
        show:show,
        hide:hide,
        updateImage:updateImage,
        hideLoading:hideLoading,
        showLoading:showLoading,
        freeze:freeze,
        unfreeze:unfreeze
    };
};
