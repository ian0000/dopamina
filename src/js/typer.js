//tiene que ir primero por que no le puedo usar antes de declarle
class Escritor {
    constructor(texto, palabras, espera = 300) {
        this.texto = texto;
        this.palabras = palabras;
        this.txt = '';
        this.conteo = 0;
        this.espera = parseInt(espera, 10); //parse int necesita el string y la base a la que va a convertir en este caso base10
        this.type();
        this.borrando = false;
    }
    type() {
        //index actual
        const actual = this.conteo % this.palabras.length;
        const completo = this.palabras[actual];

        //verifica si esta borrando
        if (this.borrando) {
            //remueve caracteres
            this.txt = completo.substring(0, this.txt.length - 1);
        } else {
            //aniade caracteres
            this.txt = completo.substring(0, this.txt.length + 1);
        }

        //insertar txt al elemento
        this.texto.innerHTML = `<span class="txt">${this.txt}</span>`;
        //velocidad inicial de tipeo
        let velocidad = 300;
        if (this.borrando) {
            velocidad /= 2;
        }

        //si la palabra esta completada
        if (!this.borrando && this.txt === completo) {
            //espera al final
            velocidad = this.espera;
            //cambiar el estadoa borrar
            this.borrando = true;
        } else if (this.borrando && this.txt === '') {
            this.borrando = false;
            //cambia a la palabra siguiente
            this.conteo++;
            //cambiar velocidad para comenzar
            velocidad = 500;
        }
        //pausa antes de comenzar
        setTimeout(() => this.type(), velocidad);

    }
}

//init cuando se cargue el DOM
document.addEventListener('DOMContentLoaded', init);

//funcion init toma los datos del span 
function init() {
    const texto = document.querySelector('.txt-type');
    //se convierte las palabras en un archivo json para que el programa las lea
    const palabras = JSON.parse(texto.getAttribute('data-words'));
    const espera = texto.getAttribute('data-wait');

    //iniciar tywritter
    new Escritor(texto, palabras, espera);
}