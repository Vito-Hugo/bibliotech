

window.onload = () =>{
    if(window.scrollY  > 80){
        document.querySelector('.header .header-2').classList.add('active');
    }else{
        document.querySelector('.header .header-2').classList.remove('active');
    }
}

var swiper = new Swiper(".books-slider", {
   loop:true,
   centeredSlides:true,
   autoplay:{
    delay:9500,
    disableOnInteraction:false,
   },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });
  var swiper = new Swiper(".featured-slider", {
    loop:true,
    centeredSlides:true,
    autoplay:{
     delay:9500,
     disableOnInteraction:false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
     breakpoints: {
       0: {
         slidesPerView: 1,
       },
       450: {
        slidesPerView: 2,
      },
       768: {
         slidesPerView: 3,
       },
       1024: {
         slidesPerView: 4,
       },
     },
   });
   var swiper = new Swiper(".arrivals-slider", {
    loop:true,
    centeredSlides:true,
    autoplay:{
     delay:9500,
     disableOnInteraction:false,
    },
     breakpoints: {
       0: {
         slidesPerView: 1,
       },
       768: {
         slidesPerView: 2,
       },
       1024: {
         slidesPerView: 3,
       },
     },
   });
   function alugarLivro(livroId) {
    // Send an AJAX request to alugar_livro.php with the livroId
    // Replace the URL with the appropriate file
    var url = "alugar_livro.php?livro-id=" + livroId;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response if needed
            alert("Livro alugado com sucesso!");
        }
    };
    xhr.send();
}
