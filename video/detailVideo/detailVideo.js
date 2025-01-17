const actores = JSON.parse(localStorage.getItem("actoresVideo"));;

const div = document.getElementById("actores");
const h1 = document.createElement("h1");
h1.textContent = localStorage.getItem("titulo");
div.style.margin = "0 auto";
h1.style.fontSize = "50px";
div.appendChild(h1);
for (let actor of actores){
    const p = document.createElement("p");
    p.textContent = actor.nombre;
    div.appendChild(p);
}
const button = document.getElementById("button");
button.addEventListener("click", () => {
    localStorage.removeItem("titulo");
    localStorage.removeItem("actoresVideo");
    window.location.href = "../video.view.php";
});
