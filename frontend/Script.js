/* Ejecutar funcion en el evento click */
document.getElementById("btn_open").addEventListener("click", open_close_menu);
/*Declarar Variables */
var side_menu = document.getElementById("menu_side");
var btn_open = document.getElementById("btn_open");
var body = document.getElementById("body");

/*Evento para ostrar y ocultar menu */
function open_close_menu(){
    body.classList.toggle("body__move"); /*Manda a llamar la clas imaginaria en css que abre el menu al dar click */
    side_menu.classList.toggle("menu__side__move");/* */
}

/*si el ancho de la pagina en menor a 760px, se ocultará el menú al recargar la pagina */

if(window.innerWidth<760){
    body.classList.add("body__move");
    side_menu.classList.add("menu__side__move");
}

/*menu responsive */
window.addEventListener("resize",function(){
    if (window.innerWidth>760){
        body.classList.remove("body__move");
        side_menu.classList.remove("menu__side__move");
    }
    if (window.innerWidth<760){
        body.classList.add("body__move");
        side_menu.classList.add("menu__side__move");
    }
});