require('svgxuse');
var idleJs = require('idle-js');

global.jQuery = require('jquery');
global.$ = jQuery;


const
    grid = require('./grid/grid.js'),
    gallery = require('./gallery/gallery.js');

document.addEventListener('DOMContentLoaded', function(){
    grid.init();
    gallery.init();

    new idleJs({
        idle: 300000,
        events: ['mousemove','keydown','mousedown','touchstart'],
        onIdle: function(){
            window.location = window.location.href.indexOf("/museum") > -1 ? '/museum' : '/';
        }
    }).start();
});


// OVERRIDE IMPRESS CODE (yes, the dirty way 😔):

// Prevent default keydown action when one of supported key is pressed.
document.addEventListener( "keydown", function( event ) {
    if ( event.keyCode === 9 ||
       ( event.keyCode >= 32 && event.keyCode <= 34 ) ||
       ( event.keyCode >= 37 && event.keyCode <= 40 ) ) {
        event.preventDefault();
    }
}, false );

// Trigger impress action (next or prev) on keyup.

// Supported keys are:
// [space] - quite common in presentation software to move forward
// [up] [right] / [down] [left] - again common and natural addition,
// [pgdown] / [pgup] - often triggered by remote controllers,
// [tab] - this one is quite controversial, but the reason it ended up on
//   this list is quite an interesting story... Remember that strange part
//   in the impress.js code where window is scrolled to 0,0 on every presentation
//   step, because sometimes browser scrolls viewport because of the focused element?
//   Well, the [tab] key by default navigates around focusable elements, so clicking
//   it very often caused scrolling to focused element and breaking impress.js
//   positioning. I didn't want to just prevent this default action, so I used [tab]
//   as another way to moving to next step... And yes, I know that for the sake of
//   consistency I should add [shift+tab] as opposite action...
document.addEventListener( "keyup", function( event ) {

    if ( event.shiftKey || event.altKey || event.ctrlKey || event.metaKey ) {
        return;
    }

    if ( event.keyCode === 9 ||
       ( event.keyCode >= 32 && event.keyCode <= 34 ) ||
       ( event.keyCode >= 37 && event.keyCode <= 40 ) ) {
        switch ( event.keyCode ) {
            case 33: // Page up
            case 37: // Left
            case 38: // Up
                    if(!gallery.isActive){impress().prev();}
                    break;
            case 9:  // Tab
            case 32: // Space
            case 34: // Page down
            case 39: // Right
            case 40: // Down
                    if(!gallery.isActive){impress().next();}
                    break;
        }

        event.preventDefault();
    }
}, false );