$(document).ready(function(){
	$(document).on('shown.bs.modal','#Modal', function (event) {
		var button = $(event.relatedTarget) // objeto que disparó el modal
        var url = document.getElementById("imgMaxSize").src;
        var nombre = button.data('nombre')
        
        // console.log("modal: "+url);
        // Actualiza los datos del modal
        var modal = $(this)
        modal.find('.modal-title').text(nombre);
        document.getElementById("imgproducto").src=url;
	})
});

function changeImage(url) {
    document.getElementById("imgMaxSize").src= "admin/img/productos/"+url;
    // console.log("change: "+url);
}

function changeImage2(url) {
    document.getElementById("imgMaxSize2").src= "admin/img/productos/"+url;
    // console.log("change: "+url);
}
// $('.owl-carousel').owlCarousel({
//     loop:true,
//     margin:10,
//     nav:true,
//     responsive:{
//         0:{
//             items:1
//         },
//         600:{
//             items:3
//         },
//         1000:{
//             items:5
//         }
//     }
// })

var owl = $('.prod-carousel1');
owl.owlCarousel({
    items:5,
    loop:true,
    margin:20,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true
});

var owl = $('.prod-carousel2');
owl.owlCarousel({
    items:1,
    loop:true,
    margin:20,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true
});