var jugando=true;
var pPuntaje=document.getElementById('puntaje');
var pComentarios=document.getElementById('comentarios');

var puntaje=0;
var puntajeMax=0;
var btnJugar=document.getElementById('jugar');
btnJugar.onclick=function(){
        jugando=true;
        elementos=[];
        var vRandom=obtenerValorRandom(0,jsonElementos.length);
        elementos.push(new Elemento(window_width/2,140,50,50,jsonElementos[vRandom].src,jsonElementos[vRandom].tipo,1,jsonElementos[vRandom].nombre));
        sumarFrecuencia(jsonElementos[vRandom].nombre);
        game();
}


var jsonElementos=[];
var elementos=[];
var contenedores=[];

var srcEnemigos=['./img/basura en mar.png','./img/calentamiento global.png','./img/co2.png','./img/reloj.png'];
var enemigos=[];
var nEnemigos=3;
var sacarEnemigo=false;
var enemigoASacar;



let canvas=document.getElementById("canvas");
var window_height=window.innerHeight;
var window_width=window.innerWidth;
canvas.width=window_width;
canvas.height=window_height;
var ctx=canvas.getContext("2d");

function move(event){
    if(elementos.length>0){
        var el=elementos[elementos.length-1];
        if(event.keyCode=='39' && (el.width+el.xpos)<window_width){
            el.xpos+=10;
        }
        if(event.keyCode=='37' && el.xpos>0){
            el.xpos-=10;
        }
        if(event.keyCode=='40' && (el.height+el.ypos)<window_height){
            el.ypos+=30;
        }
        if(event.keyCode=='65'){
            el.ypos=window_height-150;
        }  
    }
    
}
peticion_http=new XMLHttpRequest();
peticion_http.onreadystatechange=agregarContenedores;
peticion_http.open('GET','contenedores.json',false);
peticion_http.send(null);

function agregarContenedores(){
    if(peticion_http.readyState==4){
        if(peticion_http.status==200){
            var dataJson=peticion_http.responseText;
            var dataParsed=JSON.parse(dataJson);

            var espacio=0;
            for(el of dataParsed){
                
                contenedores.push(new Contenedor(espacio,window_height-100,100,100,el.src,el.tipo,el.nombre));
                espacio+=window_width/dataParsed.length;
            }
        }
    }
}
peticion_http2=new XMLHttpRequest();
peticion_http2.onreadystatechange=agregarElementos;
peticion_http2.open('GET','elementos.json',false);
peticion_http2.send(null);

function agregarElementos(){
    if(peticion_http2.readyState==4){
        if(peticion_http2.status==200){
            var dataJson=peticion_http2.responseText;
            var dataParsed=JSON.parse(dataJson);
            jsonElementos=dataParsed;
            
            var vRandom=obtenerValorRandom(0,jsonElementos.length-1);
            elementos.push(new Elemento(window_width/2,140,50,50,jsonElementos[vRandom].src,jsonElementos[vRandom].tipo,1,jsonElementos[vRandom].nombre));
            sumarFrecuencia(jsonElementos[vRandom].nombre);
        }
    }
}
var instrucciones=new Img(window_width-400,window_height/2,400,200,'./img/botones.png');
for (let i=0;i<nEnemigos ; i++) {
    enemigos.push(new Enemigo(obtenerValorRandom(0,window_width-100),obtenerValorRandom(140,window_height-100),100,100,srcEnemigos[obtenerValorRandom(0,srcEnemigos.length)]));
}


function game(){
    ctx.clearRect(0,0,window_width,window_height);
    
    if(jugando){
    requestAnimationFrame(game);
    }
    instrucciones.draw(ctx);

    for (en of enemigos){
        en.update(ctx);
    }
    for(el of elementos){
        el.update(ctx);
    }
    for(co of contenedores){
        co.draw(ctx);
    }
    for(el of elementos){
        for(co of contenedores){
            if(colision(el,co)){return;}
        }
        for(en of enemigos){
            if(colisionEnemigo(el,en)){sacarEnemigo=true; enemigoASacar=en;}
        }
        if(sacarEnemigo){
            enemigos=eliminarEnemigo(enemigos,enemigoASacar); sacarEnemigo=false;
        }

    }
    if(!jugando){
        alertaPerder(ctx);
    }

}
