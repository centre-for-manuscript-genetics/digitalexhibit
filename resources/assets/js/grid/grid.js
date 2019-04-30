require('../../../../impress/impress.js/js/impress.js');
var Modernizr = require('browsernizr');

module.exports = new function grid(){
    const
        self = this;

    self.init = function(){

        if($('#impress').length){

            var rootElement = document.getElementById( "impress" );
            rootElement.addEventListener( "impress:init", function() {

            });

            rootElement.addEventListener( "impress:stepenter", self.handleSlideEnter);

            impress().init();
            this.initButtons(impress());
            this.initNavigation();
        }
    }

    self.initButtons = function(){

        $('.js-grid--next').each(function(){

            $(this).on({'touchstart click': function(e){
                e.stopPropagation();
                e.preventDefault();
                impress().next();
            }});
        });

        $('.js-grid--prev').each(function(){

            $(this).on({'touchstart click': function(e){
                e.stopPropagation();
                e.preventDefault();
                impress().prev();
            }});
        });

        $('.js-toggle-play').each(function(){

            $(this).on({'click': function(e){
                e.stopPropagation();
                self.toggleAudioButton($(this));
            }});
        });
    }

    self.initNavigation= function(){

        $(document).bind('touchmove', function(e) {
            e.stopPropagation();
            e.preventDefault();
        });

        var rootElement = document.getElementById( "impress" );

        rootElement.addEventListener( "impress:stepleave", function(e) {
          self.removeNavigationActiveState();
          self.stopAudio($(e.target).find('.js-toggle-play'), $(e.target).find('audio'));
        });

        rootElement.addEventListener( "impress:stepenter", function() {
          var currentStep = document.querySelector( ".present" );
          var id = currentStep.id;

          self.toggleNavigationState(id);
        });

        $('.c-footer__navigation .c-navigation__button').each(function(){
            $(this).on({'touchstart click': function(e){
                e.stopPropagation();
                e.preventDefault();
                impress().goto($(this).data('slide'));
                $(this).unbind('mouseenter mouseleave');
            }});
        });
    }

    self.toggleAudioButton = function(button) {
        var audio = $(button).next('audio');

        if(audio[0].paused){
            self.startAudio(button, audio);
        } else {
            self.stopAudio(button, audio);
        }
    }

    self.stopAudio = function(button, audio) {
        if(button.length > 0 && audio.length > 0){
            $(button).removeClass('is-playing');
            audio[0].pause();
        }
    }

    self.startAudio = function(button, audio) {
        $(button).addClass('is-playing');
        audio[0].play();
    }

    self.removeNavigationActiveState = function() {
        $('.c-footer__navigation .c-navigation__button').removeClass('is-active');
    }

    self.toggleNavigationState = function(activeSlideID) {
        self.removeNavigationActiveState();

        var activeSlide = $('.c-footer__navigation .c-navigation__button[data-slide="' + activeSlideID + '"]');
        $(activeSlide).addClass('is-active');
    }

    self.handleSlideEnter = function(e) {
        e.target.removeEventListener(e.type, arguments.callee);
        $('.is-loading').removeClass('is-loading');
    }
}