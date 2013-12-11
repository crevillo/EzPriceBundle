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
var b;

ezie.gui.config.bind.reload_saved = function(new_block) {
    var button = ezie.gui.eziegui.getInstance().button();
    b = button;
    var ez_edit_block = button.closest('fieldset');

    ez_edit_block.find('div.block').remove();

    ez_edit_block.find('legend:first').after(new_block);

    ez_edit_block.find(".ezieEditButton").ezie();
}

ezie.gui.config.bind.menu_save_and_close = function() {
    if (!ezie.gui.eziegui.isInstanciated()) {
        return;
    }

    $.log('starting save + close');

    ezie.gui.config.zoom().reset();

    ezie.ezconnect.connect.instance().action({
        'action': 'save_and_quit',
        'success': function(response) {
            ezie.gui.config.bind.reload_saved(response);
            $('#main_image, #miniature').empty();
            ezie.gui.eziegui.getInstance().close();

            $('#ezieToolsWindow').find('.current').removeClass('current');
            $('#ezie_zoom').parent().addClass('current');

            ezie.gui.eziegui.getInstance().desactivateUndo();
            ezie.gui.eziegui.getInstance().desactivateRedo();
        },
        dataType: 'html'
    });
}
