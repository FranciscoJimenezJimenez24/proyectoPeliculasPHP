const videos = JSON.parse(localStorage.getItem("videos"));
const videoContainer = document.getElementById("video-container");
videoContainer.innerHTML = ""; 
videos.forEach(video => {
    const videoCard = document.createElement("div");
    videoCard.classList.add("card", "mb-3");

    videoCard.innerHTML = `
            <div>
                <h5>${video.titulo}</h5>
                <p>Duración: ${video.minuto_duracion} minutos</p>
                <p>Fecha de estreno: ${video.fecha_estreno}</p>
            </div>
        `;

    videoContainer.appendChild(videoCard);
});

