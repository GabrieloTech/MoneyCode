const formulario = document.getElementById("formComentario");

formulario.addEventListener("submit", function(event) {


    event.preventDefault();


    const nome = document.getElementById("nome").value;
    const comentario = document.getElementById("comentario").value;


    if (nome === "" || comentario === "") {
        alert("Preencha todos os campos!");
        return;
    }


    const novoComentario = document.createElement("div");

    novoComentario.classList.add("comentario");

    novoComentario.innerHTML = `
        <h3>${nome}</h3>
        <p>${comentario}</p>
    `;


    document.getElementById("listaComentarios")
        .appendChild(novoComentario);


    document.getElementById("nome").value = "";
    document.getElementById("comentario").value = "";
});