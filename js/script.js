document.getElementById("btn_Login").addEventListener("click",login);
document.getElementById("btn_singup").addEventListener("click",register);
//Esta funcion se ejecutara cuando se vaya haciendo resize en la pagina
window.addEventListener("resize", ancho_p);


//Declaración de variables
var formulariologin = document.querySelector(".form_login");
var formularioregistro = document.querySelector(".form_registrar");
var cloginregistro = document.querySelector(".loginregistro");
var cajatraseral = document.querySelector(".caja_traseralogin");
var cajadelanterar = document.querySelector(".caja_delanteraregistro");


function ancho_p(){
    if(window.innerWidth > 850){
        cajadelanterar.style.display="block";
        cajatraseral.style.display="block";

    }else{
        cajadelanterar.style.display="block";
        cajadelanterar.style.opacity="1";
        cajatraseral.style.display="none";
        formulariologin.style.display="block";
        formularioregistro.style.display="none";
        cloginregistro.style.left="0px";
    }
}
ancho_p();

//creamos el diseño para cada formulario 
function register(){
    if(window.innerWidth > 850){
formularioregistro.style.display = "block";
cloginregistro.style.left = "430px";
formulariologin.style.display = "none";
cajadelanterar.style.opacity="0";
cajatraseral.style.opacity = "1";
} else{
formularioregistro.style.display = "block";
cloginregistro.style.left = "20px";
formulariologin.style.display = "none";
cajadelanterar.style.display="none";
cajatraseral.style.display = "block";
}
}
function login(){
    if(window.innerWidth > 850){
    formularioregistro.style.display="none";
    cloginregistro.style.left = "20px";
    formulariologin.style.display = "block";
    cajadelanterar.style.opacity = "1";
    cajatraseral.style.opacity = "0";
}else{
formularioregistro.style.display = "none";
cloginregistro.style.left = "0px";
formulariologin.style.display = "block";
cajadelanterar.style.display="block";
cajatraseral.style.display="none";

}
}
