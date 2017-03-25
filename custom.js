

$(document).ready(function(){

  $('.owl-carousel').owlCarousel({

    //navigation: true, //Show next and previous buttons
  //  slideSpeed: 300,
  //paginationSpeed: 400,
  //  singleItem: true

  //items: 1,
  loop: true,
  margin: 0,
  nav: false,
  dots: true,
  smartSpeed: 800,
// autoHeight: true

  //  loop:true,
    //margin:10,
    //nav:true,
   responsive:{
        0:{
           items:1
        },
        600:{
            items:1
       },
        1000:{
            items:1
        }
    }
  });



});
