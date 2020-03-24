// let add = (a,b) => a+b
// console.log(add(8,3))

document.getElementById('show-menu').addEventListener("click", function(){
  let mobMenu = document.getElementById('mob-menu');
  mobMenu.style.display = (mobMenu.style.display == 'none') ? 'flex' : 'none'
})
var closeMenu = function(){
  let mobMenu = document.getElementById('mob-menu');
  mobMenu.style.display = 'none';
}

var elements = document.getElementsByClassName("close-menu");
for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', closeMenu, false);
}