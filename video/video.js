const videos = JSON.parse(localStorage.getItem("videos"));
const tableVideos = document.getElementById("tableVideos");

tableVideos.innerHTML = "";

const tr = document.createElement("tr");

const thTitulo = document.createElement("th");
const thDuration = document.createElement("th");
const thFechaEstreno = document.createElement("th");
const thCRUD = document.createElement("th");

thTitulo.textContent = "Titulo";
thDuration.textContent = "Duración";
thFechaEstreno.textContent = "Fecha Estreno";
thCRUD.textContent = "Acciones";

tr.appendChild(thTitulo);
tr.appendChild(thDuration);
tr.appendChild(thFechaEstreno);
tr.appendChild(thCRUD);

tableVideos.appendChild(tr);
videos.forEach(video => {
    const tr = document.createElement("tr");

    const tdTitle = document.createElement("td");
    const tdDuration = document.createElement("td");
    const tdFechaEstreno = document.createElement("td");
    const tdCRUD = document.createElement("td");

    tdTitle.textContent = video.titulo;
    tdDuration.textContent = video.minuto_duracion;
    tdFechaEstreno.textContent = video.fecha_estreno;
    tdCRUD.innerHTML = `
        <button class='buttonGreen' onclick='getVideo(${video.id}, "${video.titulo}", "${video.minuto_duracion}","${video.fecha_estreno}")'>Editar</button>
        <button class='buttonRed' onclick='deleteVideo(${video.id})'>Eliminar</button>
    `;

    tr.appendChild(tdTitle);
    tr.appendChild(tdDuration);
    tr.appendChild(tdFechaEstreno);
    tr.appendChild(tdCRUD);

    tableVideos.appendChild(tr);
});
function getVideo(id, titulo, duracion, fecha_estreno) {
    document.getElementById("idVideo").value = id;
    document.getElementById("titulo").value = titulo;
    document.getElementById("minuto_duracion").value = duracion;
    document.getElementById("fecha_estreno").value = fecha_estreno;
}

function deleteVideo(id) {
    document.getElementById("idVideoDelete").value = id;
}
const add = document.getElementById("add");
const interfazCreate = document.getElementById("interfazCreate");
const overlayCreate = document.getElementById("overlayCreate");
const cerrarInterfazBtnCreate = document.getElementById("cerrarInterfazBtnCreate");

add.addEventListener("click", () => {
    const tipo_video = localStorage.getItem("tipo_video");
    document.getElementById("tipo_video").value = parseInt(tipo_video);
    interfazCreate.classList.remove("ocultoCreate");
    overlayCreate.classList.remove("ocultoCreate");

});

cerrarInterfazBtnCreate.addEventListener("click", () => {
    interfazCreate.classList.add("ocultoCreate");
    overlayCreate.classList.add("ocultoCreate");
});

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

const buttonsRed = document.querySelectorAll(".buttonRed");
const interfazDelete = document.getElementById("interfazDelete");
const overlayDelete = document.getElementById("overlayDelete");
const cerrarInterfazBtnDelete = document.getElementById("cerrarInterfazBtnDelete");

buttonsRed.forEach(button => {
    button.addEventListener("click", () => {
        interfazDelete.classList.remove("ocultoDelete");
        overlayDelete.classList.remove("ocultoDelete");
    });
});

cerrarInterfazBtnDelete.addEventListener("click", () => {
    interfazDelete.classList.add("ocultoDelete");
    overlayDelete.classList.add("ocultoDelete");
});

const back = document.getElementById("back");
back.addEventListener("click", () => {
    localStorage.removeItem("videos");
    localStorage.removeItem("tipo_video");
});

document.addEventListener('DOMContentLoaded', () => {
    // Editar
    buttonsGreen.forEach(button => {
        button.addEventListener("click", (event) => {
            const videoId = event.target.getAttribute('onclick').match(/\d+/)[0]; // Extrae el id del video
            const titulo = event.target.getAttribute('onclick').match(/"(.*?)"/g)[0].replace(/"/g, ''); // Extrae el titulo
            const duracion = event.target.getAttribute('onclick').match(/"(.*?)"/g)[1].replace(/"/g, ''); // Extrae la duracion
            const fechaEstreno = event.target.getAttribute('onclick').match(/"(.*?)"/g)[2].replace(/"/g, ''); // Extrae la fecha de estreno

            getVideo(videoId, titulo, duracion, fechaEstreno);
        });
    });

    // Eliminar
    const buttonsRed = document.querySelectorAll('.buttonRed');
    buttonsRed.forEach(button => {
        button.addEventListener("click", (event) => {
            const videoId = event.target.getAttribute('onclick').match(/\d+/)[0]; // Extrae el id del video    
            deleteVideo(videoId);
        });
    });
});
