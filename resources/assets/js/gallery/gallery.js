require('lightgallery');
require('lightgallery/dist/js/lg-zoom');

module.exports = new function grid(){
    const self = this;

    isActive = false,

    self.init = function(){

        $('.js-gallery').each(function(){
            var lg = $(this).lightGallery({
              thumbnail: true,
              selector: ".c-gallery__item"
            });

            lg.on('onBeforeOpen.lg',function(e){
                self.isActive = true;
            });

            lg.on('onBeforeClose.lg',function(e){
                self.isActive = false;
            });
        });
    }
}