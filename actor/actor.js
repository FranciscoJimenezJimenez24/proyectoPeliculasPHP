const actores = JSON.parse(localStorage.getItem("actores"));
const allVideos = JSON.parse(localStorage.getItem("allVideos"));
const tableActores = document.getElementById("tableActores");

tableActores.innerHTML = "";

const tr = document.createElement("tr");

const thNombre = document.createElement("th");
const thObras = document.createElement("th");
const thCRUD = document.createElement("th");

thNombre.textContent = "Nombre";
thObras.textContent = "Obras";
thCRUD.textContent = "Acciones";

tr.appendChild(thNombre);
tr.appendChild(thObras);
tr.appendChild(thCRUD);

tableActores.appendChild(tr);
actores.forEach(actor => {

    const tr = document.createElement("tr");

    const tdNombre = document.createElement("td");
    const tdObras = document.createElement("td");
    const tdCRUD = document.createElement("td");

    tdNombre.textContent = actor.nombre;
    let obrasActor = actor.videos.split(",");
    const div = document.createElement("div");
    for (let i = 0; i < obrasActor.length; i++) {
        const video = allVideos.find(video => video.id == obrasActor[i]);
        div.innerHTML += video.titulo + " (" + (video.fecha_estreno).substring(0, 4) + ")" + "<br>";
    }
    tdObras.appendChild(div)
    tdCRUD.innerHTML = `
        <button class='buttonGreen' onclick='getActor(${actor.id}, "${actor.nombre}", "${actor.videos}")'>Editar</button>
    `;

    tr.appendChild(tdNombre);
    tr.appendChild(tdObras);
    tr.appendChild(tdCRUD);

    tableActores.appendChild(tr);
});

function getActor(id, nombre, obras) {
    document.getElementById("idActor").value = id;
    document.getElementById("nombre").value = nombre;
    let obrasActor = obras.split(",");

    const div = document.getElementsByClassName("obras")[0];
    div.innerHTML = "";  // Limpiar contenido previo

    localStorage.setItem("idActor", id);
    localStorage.setItem("nombre", nombre);
    localStorage.setItem("obras", obrasActor)

    for (let i = 0; i < obrasActor.length; i++) {
        const video = allVideos.find(video => video.id == obrasActor[i]);
    
        // Crear un contenedor para cada obra
        const obraContainer = document.createElement("div");
        obraContainer.style.marginBottom = "10px";  
    
        const obraText = document.createElement("span");
        obraText.innerHTML = `${video.titulo} (${(video.fecha_estreno).substring(0, 4)})`;
        obraContainer.appendChild(obraText);
    
        // Crear el botón
        const button = document.createElement("button");
        button.type = "button";
        button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24"><path d="M 10.806641 2 C 10.289641 2 9.7956875 2.2043125 9.4296875 2.5703125 L 9 3 L 4 3 A 1.0001 1.0001 0 1 0 4 5 L 20 5 A 1.0001 1.0001 0 1 0 20 3 L 15 3 L 14.570312 2.5703125 C 14.205312 2.2043125 13.710359 2 13.193359 2 L 10.806641 2 z M 4.3652344 7 L 5.8925781 20.263672 C 6.0245781 21.253672 6.877 22 7.875 22 L 16.123047 22 C 17.121047 22 17.974422 21.254859 18.107422 20.255859 L 19.634766 7 L 4.3652344 7 z"></path></svg>';
        button.style.width = "10%";
        button.style.background = "none";
        button.style.border = "none";
    
        // Acción del botón
        button.onclick = () => {
            obrasActor.splice(i, 1);
            localStorage.setItem("obras",obrasActor.join(","));
            getActor(document.getElementById("idActor").value, document.getElementById("nombre").value, obrasActor.join(","));
        };
    
        obraContainer.appendChild(button);  
        div.appendChild(obraContainer);  
    }
    
}


// const add = document.getElementById("add");
// const interfazCreate = document.getElementById("interfazCreate");
// const overlayCreate = document.getElementById("overlayCreate");
// const cerrarInterfazBtnCreate = document.getElementById("cerrarInterfazBtnCreate");

// add.addEventListener("click", () => {
//     interfazCreate.classList.remove("ocultoCreate");
//     overlayCreate.classList.remove("ocultoCreate");
// });

// cerrarInterfazBtnCreate.addEventListener("click", () => {
//     interfazCreate.classList.add("ocultoCreate");
//     overlayCreate.classList.add("ocultoCreate");
// });

const buttonsGreen = document.querySelectorAll(".buttonGreen");
const interfazEdit = document.getElementById("interfazEdit");
const overlayEdit = document.getElementById("overlayEdit");
const cerrarInterfazBtnEdit = document.getElementById("cerrarInterfazBtnEdit");

buttonsGreen.forEach(button => {
    button.addEventListener("click", () => {
        interfazEdit.classList.remove("ocultoEdit");
        overlayEdit.classList.remove("ocultoEdit");
    });
});

cerrarInterfazBtnEdit.addEventListener("click", () => {
    interfazEdit.classList.add("ocultoEdit");
    overlayEdit.classList.add("ocultoEdit");
});

const back = document.getElementById("back");
back.addEventListener("click", () => {
    localStorage.removeItem("actores");
});

document.addEventListener('DOMContentLoaded', () => {
    // Editar
    buttonsGreen.forEach(button => {
        button.addEventListener("click", (event) => {
            const actorId = event.target.getAttribute('onclick').match(/\d+/)[0];
            const nombre = event.target.getAttribute('onclick').match(/"(.*?)"/g)[0].replace(/"/g, '');
            const obras = event.target.getAttribute('onclick').match(/"(.*?)"/g)[1].replace(/"/g, '');

            getActor(actorId, nombre, obras);
        });
    });

});

function buscar() {
    const termino = document.getElementById('search').value.toLowerCase();
    const resultados = document.getElementById('resultados');

    // Limpiar resultados previos
    resultados.innerHTML = '';

    if (termino) {
        // Filtrar el array por el término de búsqueda
        const coincidencias = allVideos.filter(item => (item.titulo).toLowerCase().includes(termino));

        // Mostrar los resultados
        if (coincidencias.length > 0) {
            coincidencias.forEach(item => {
                const li = document.createElement('li');
                li.innerHTML = item.titulo;
                li.style.cursor = "pointer";
                li.style.padding = "5px"
                li.style.backgroundColor = "#f0f0f0";
                li.style.listStyleType = "none";
                let obras = localStorage.getItem("obras");
                let obrasArray = new Set(obras.split(","));
                obrasArray.add(item.id);
                localStorage.setItem("obras", Array.from(obrasArray).join(","));
                li.onclick = () => getActor(localStorage.getItem("idActor"), localStorage.getItem("nombre"), Array.from(obrasArray).join(","));
                resultados.appendChild(li);
            });
        } else {
            resultados.innerHTML = 'No se encontraron resultados.';
        }
    }
}