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
        div.innerHTML += video.titulo + " (" + (video.fecha_estreno).substring(0, 4) + ")" + "<br>";
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
                li.onclick = () => getActor(localStorage.getItem("idActor"), localStorage.getItem("nombre"), Array.from(obrasArray).join(","));
                resultados.appendChild(li);
            });
        } else {
            resultados.innerHTML = 'No se encontraron resultados.';
        }
    }
}