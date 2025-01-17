document.getElementById("documentaries").addEventListener("click", function () {
    localStorage.setItem("tipo_video", 3);
    sendTipeVideo(3);
});
document.getElementById("series").addEventListener("click", function () {
    localStorage.setItem("tipo_video", 2);
    sendTipeVideo(2);
});
document.getElementById("movies").addEventListener("click", function () {
    localStorage.setItem("tipo_video", 1);
    sendTipeVideo(1);
});

document.getElementById("actors").addEventListener("click", function () {
    sendAllVideos();
    sendActors();
});

function sendTipeVideo(tipo_video) {
    fetch("../video/video.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({ tipo_video: tipo_video })
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error); 
            } else {
                localStorage.setItem("videos", JSON.stringify(data));
                window.location.href = "../video/video.view.php";
            }
        })
        .catch(error => console.error('Error:', error));
}

function sendActors(){
    fetch("../actor/actor.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            localStorage.setItem("actores", JSON.stringify(data));
            window.location.href = "../actor/actor.view.php";
        }
    })
    .catch(error => console.error('Error:', error));
}
function sendAllVideos(){
    fetch("../video/crudVideo/allvideos.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            localStorage.setItem("allVideos", JSON.stringify(data));
        }
    })
    .catch(error => console.error('Error:', error));
}
