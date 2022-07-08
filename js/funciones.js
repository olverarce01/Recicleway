
class Img{
    constructor(xpos,ypos,width,height,src){
    this.xpos=xpos;
    this.ypos=ypos;
    this.width=width;
    this.height=height;
    this.img=new Image();
    this.img.src=src;
    }
    draw(context){
        context.drawImage(this.img,this.xpos,this.ypos,this.width,this.height);
    }
}
class Contenedor{
    constructor(xpos,ypos,width,height,src, tipo,nombre){
    this.xpos=xpos;
    this.ypos=ypos;
    this.width=width;
    this.height=height;
    this.img=new Image();
    this.img.src=src;
    this.tipo=tipo;
    this.nombre=nombre;
    }
    draw(context){
        context.drawImage(this.img,this.xpos,this.ypos,this.width,this.height);
    }
}
class Elemento{
    constructor(xpos,ypos,width,height,src,tipo,dy,nombre){
    this.xpos=xpos;
    this.ypos=ypos;
    this.width=width;
    this.height=height;
    this.img=new Image();
    this.img.src=src;
    this.dy=dy;
    this.tipo=tipo;
    this.nombre=nombre;

    //this.llama=new Image();
    //this.llama.src='./img/frames/0.gif';
    //this.frames=[];
    //for(let i=0;i<7;i++){
    //    this.frames.push(`./img/frames/${i}.gif`);
    //}
    //this.indice=0;
    }
    draw(context){
        context.drawImage(this.img,this.xpos,this.ypos,this.width,this.height);
        //context.drawImage(this.llama,this.xpos,this.ypos-50,this.width,this.height);
    }
    update(context){
        //context.clearRect(0,0,window_width,window_height);
        this.draw(context);
        if((this.ypos+this.height)>window_height){
            this.dy=-this.dy;
            jugando=false;
        }
        if(this.ypos<140){
            this.dy=-this.dy;
        }
        this.ypos+=this.dy;

        //this.indice++;
        //if(this.indice==this.frames.length)this.indice=0;
        //this.llama.src=this.frames[this.indice];
    }
}

class Enemigo{
    constructor(xpos,ypos,width,height,src){
    this.xpos=xpos;
    this.ypos=ypos;
    this.width=width;
    this.height=height;
    this.img=new Image();
    this.img.src=src;
    this.dy=1;
    this.dx=1;
    }
    draw(context){
        context.drawImage(this.img,this.xpos,this.ypos,this.width,this.height);
    }
    update(context){
        this.draw(context);


        if((this.ypos+this.height)>window_height){
            this.dy=-this.dy;
        }
        if(this.ypos<140){
            this.dy=-this.dy;
        }

        if((this.xpos+this.width)>window_width){
            this.dx=-this.dx;
        }
        if(this.xpos<0){
            this.dx=-this.dx;
        }
        this.ypos+=this.dy;
        this.xpos+=this.dx;
    }
}
function obtenerValorRandom(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}

function eliminarEnemigo(array, elemento) {
    var resultado=[];
    for(var i=0; i<array.length;i++){
        if(array[i]!==elemento){
            resultado.push(array[i]);
        }
    }
    return resultado;
}


function colision(img1,img2){
var xpos1=img1.xpos;
var ypos1=img1.ypos;
var width1=img1.width;
var height1=img1.height;

var xpos2=img2.xpos;
var ypos2=img2.ypos;
var width2=img2.width;
var heigh2=img2.height;

    if(xpos1<xpos2+width2 &&
        xpos1+width1>xpos2 &&
        ypos1<ypos2+heigh2 &&
        ypos1+height1>ypos2){

        elementos.pop();
        if(img1.tipo != img2.tipo){
        puntaje=0;
        pPuntaje.textContent=`Puntaje: ${puntaje} / ${puntajeMaxT}`;
        

        for(co of contenedores){
        if(co.tipo==img1.tipo){
        pComentarios.textContent=`comentarios: El residuo ${img1.nombre} no va en ${img2.nombre}. Debe ir en ${co.nombre}`;
        }
        }
        sumarFallo(img1.nombre);
        jugando=false;
        return true;    
        
        }else{
            puntaje++;
            actualizarPuntajeMax(puntaje);
            pPuntaje.textContent=`Puntaje: ${puntaje} / ${puntajeMaxT}`;
            

            var vRandom=obtenerValorRandom(0,jsonElementos.length);
            elementos.push(new Elemento(window_width/2,140,50,50,jsonElementos[vRandom].src,jsonElementos[vRandom].tipo,1,jsonElementos[vRandom].nombre));
            sumarFrecuencia(jsonElementos[vRandom].nombre);   
        }          
    }
    return false;
}
function colisionEnemigo(img1,img2){
var xpos1=img1.xpos;
var ypos1=img1.ypos;
var width1=img1.width;
var height1=img1.height;

var xpos2=img2.xpos;
var ypos2=img2.ypos;
var width2=img2.width;
var heigh2=img2.height;

    if(xpos1<xpos2+width2 &&
        xpos1+width1>xpos2 &&
        ypos1<ypos2+heigh2 &&
        ypos1+height1>ypos2){

        if(puntaje>0){
        puntaje--;
        pPuntaje.textContent=`Puntaje: ${puntaje} / ${puntajeMaxT}`;
        
        }
        enemigos.push(new Enemigo(obtenerValorRandom(0,window_width-100),obtenerValorRandom(140,window_height-100),100,100,srcEnemigos[obtenerValorRandom(0,srcEnemigos.length)]));
        return true;
    }
    return false;
}
function alertaPerder(ctx){
    ctx.fillStyle = "#20b2aa";
    ctx.fillRect((window_width/2)-200,(window_height/2)-100, 400, 150);
    ctx.fillStyle = "black";
    ctx.font = "60px monospace";
    ctx.textAlign = "center";
    ctx.fillText("Perdiste",window_width/2,window_height/2);

}