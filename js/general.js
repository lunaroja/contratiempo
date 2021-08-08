
jQuery(document).ready(function($) {

    $('.category-name.publicaciones').each(function(index) {
        //get the first word
        var firstWord = $(this).text().split(' ')[0];

        //wrap it with span
        var replaceWord = "<span class='year'>" + firstWord + "</span>";

        //create new string with span included
        var newString = $(this).html().replace(firstWord, replaceWord);

        //apply to the divs
        $(this).html(newString);
    });

    $('.carousel-uno').owlCarousel({
        loop:true,
        margin:0,
        nav:false,
        animateOut: 'fadeOut',
        items:1,
        autoplay:true,
        autoplayTimeout:7000,
        autoplayHoverPause:true
    });


    $('.carousel-dos').owlCarousel({
        loop:false,
        margin:0,
        nav:true,
        animateOut: 'fadeOut',
        responsive:{
              0:{
                  items:1,
                  nav:true
              },
              900:{
                  items:4,
                  nav:false
              }
          },
        autoplay:false
    });

    $('.menu-wrapper').on('click', function() {
        $('.hamburger-menu').toggleClass('animate');
        $('#mobile').toggleClass('open');
    })


});
