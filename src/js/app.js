document.addEventListener("DOMContentLoaded", function(){
    eventListeners();
    darkMode();
})

function darkMode(){
    const prefiereDarkMode = window.matchMedia("(prefers-color-scheme:dark");

    if(prefiereDarkMode.matches){
        document.body.classList.add("darkmode");
    }else {
        document.body.classList.remove("darkmode");
    }

    prefiereDarkMode.addEventListener("change", function(){
        if(prefiereDarkMode.matches){
            document.body.classList.add("darkmode");
        }else {
            document.body.classList.remove("darkmode");
        }
    })
    
    const btnDarkMode = document.querySelector(".boton-dark-mode");
    btnDarkMode.addEventListener("click", function(){
        document.body.classList.toggle("darkmode");
    } )
}

function eventListeners(){
    const hamburguesa = document.querySelector(".mobile");
    hamburguesa.addEventListener("click",mostrarClase );
}

function mostrarClase(){
    const nav = document.querySelector(".navegacion");
    if (nav.classList.contains("mostrar")){
        nav.classList.remove("mostrar")
    }else{
        nav.classList.add("mostrar")
    }
}