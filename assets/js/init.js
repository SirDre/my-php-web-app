(function($) {
    $(function() {
 
        var $container = $('.masonry-grid');
        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.item',
                gutter: 0
            });
            $(".item").css("opacity", "1");
            $(".section").each(function() {
                var header = $(this).children(".fixed-wrapper").first().children("h1").first();
                var offset = $(this).offset().top;
                var next = $(this).next();
                var offsetNext = $(document).height() - next.offset().top;
                header.affix({
                    offset: {
                        top: offset,
                        bottom: offsetNext
                    }
                });
            });
            $('body').scrollspy({
                target: '#navbar'
            });
        });
     
    });
})(jQuery);