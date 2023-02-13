// Cuando el usuario hace scroll en la página, muestra el botón
function scroll(){
    window.onscroll = function() {scrollFunction()};
    $("#myBtn").on("click",function(){
        $("#inicio").animatescroll({scrollSpeed:2000,easing:'easeInOutBack'});
    })
}

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}
