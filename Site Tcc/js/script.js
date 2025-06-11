function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
  }
   
  // Fecha o menu lateral
  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
  }
  
  // Mostra imagem em tamanho maior no modal
  function onClick(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
    var captionText = document.getElementById("caption");
    captionText.innerHTML = element.alt;
  }

document.addEventListener("DOMContentLoaded", function () {
  const pato = document.getElementById("pato");
  const som = document.getElementById("som-pato");

  pato.addEventListener("click", function () {
    som.currentTime = 0; // Reinicia o áudio, se quiser sempre do início
    som.play();
  });
});

function mostrarInfo(nome) {
  const painel = document.getElementById(`info-${nome}`);
  painel.style.display = 'block';
}

function fecharInfo(nome) {
  const painel = document.getElementById(`info-${nome}`);
  painel.style.display = 'none';
}