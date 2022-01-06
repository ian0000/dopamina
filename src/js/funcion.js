let carro = [];


function add(valor, id, stock) {
    value = parseInt(document.getElementById('value-' + id).innerText);
    if ((value == 0 && valor > 0 || value > 0) && value < stock) {
        value += valor;
    } else if (value == stock && valor < 0) {
        value += valor;
    }
    document.getElementById('value-' + id).innerHTML = value;
    carrito(id);
}

function retrieve(valor, id) {
    document.getElementById('value-' + id).innerHTML = valor;
    carrito(id);
}

function carrito(id) {
    sumaTotal = 0;
    value = parseInt(document.getElementById('value-' + id).innerText);
    if (carro.length > 0) {
        i = 0;
        carro.forEach(element => {
            if (element['id'] == id) {
                carro.splice(i, 1);
                crearElemento(element['id'], value, 2)
            }
            i++;
        });
    }

    carro.push({ "id": id, "cantidad": value });

    crearElemento(id, value, 0);
    if (value == 0) {
        j = 0;
        carro.forEach(element => {
            if (element['cantidad'] == 0) {
                carro.splice(j, 1);
                crearElemento(element['id'], value, 2)
            }
            j++;
        });
    }

    if (carro.length > 0) {
        i = 0;
        carro.forEach(element => {
            sumaTotal += parseInt(element['cantidad']);
            total(sumaTotal);
        });
    }
    if (!carro) {

        document.getElementById('id').value = JSON.stringify(carro);
    }

}

function total(total) {
    document.getElementById('cart').value = "Carrito  " + total;
}

function data() {
    if (carro) {
        if (!window.localStorage) alert("Sorry, you're using an ancient browser");
        else {
            localStorage.myArray = JSON.stringify(carro);
        }
    }

}

function crearElemento(id, value, caso) {
    let form = document.getElementById('form');
    switch (caso) {
        case 0:
            //este caso siempre se lo va a llmar por que es cuando se crea
            //crear input 
            let input = document.createElement('input');
            input.type = 'text';
            input.name = `item[${id}]`;
            input.id = 'id-' + id;
            input.value = id + ',' + value;
            input.className = 'cart';
            //agregar al form 
            form.appendChild(input);
            //fin crear

            break;
        case 1:
            //este caso es para cuando ya existe entonces se lo debe borrar y de ahi llamar caso 0 se podria reemplazar pero es otra cosa mas
            //case 1 seria igual al 2? podria hacer con el eliminar y ahorrarme este paso?
            break;
        case 2:
            //este caso es para cuando el valor de algun item sea igual a 0 se lo elimine
            var obtener = document.getElementById('id-' + id);
            form.removeChild(obtener);;
            break;

        default:
            break;
    }
}