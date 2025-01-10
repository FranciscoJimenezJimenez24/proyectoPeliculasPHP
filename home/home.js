document.getElementById("documentaries").addEventListener("click", function () {
    sendTipeVideo(3);
});
document.getElementById("series").addEventListener("click", function () {
    sendTipeVideo(2);
});
document.getElementById("movies").addEventListener("click", function () {
    sendTipeVideo(1);
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
