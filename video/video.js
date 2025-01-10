const videos = JSON.parse(localStorage.getItem("videos"));
const tableVideos = document.getElementById("tableVideos");

tableVideos.innerHTML = "";

const tr = document.createElement("tr");

const thTitle = document.createElement("th");
const thDuration = document.createElement("th");
const thFechaEstreno = document.createElement("th");
const thCRUD = document.createElement("th");

thTitle.textContent = "Titulo";
thDuration.textContent = "Duración";
thFechaEstreno.textContent = "Fecha Estreno";
thCRUD.textContent = "Acciones";

tr.appendChild(thTitle);
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
        <button id='buttonGreen' onclick='getVideo(${video.id}, "${video.titulo}", "${video.minuto_duracion}","${video.fecha_estreno}")'>Editar</button>
        <button id='buttonRed'>Eliminar</button>
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
const buttonGreen = document.getElementById("buttonGreen");
const interfazEdit = document.getElementById("interfazEdit");
const overlayEdit = document.getElementById("overlayEdit");
const cerrarInterfazBtn = document.getElementById("cerrarInterfazBtn");
const back = document.getElementById("back");

buttonGreen.addEventListener("click", () => {
    interfazEdit.classList.remove("ocultoEdit");
    overlayEdit.classList.remove("ocultoEdit");
});

cerrarInterfazBtn.addEventListener("click", () => {
    interfazEdit.classList.add("ocultoEdit");
    overlayEdit.classList.add("ocultoEdit");
});


