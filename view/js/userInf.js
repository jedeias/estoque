

var perfil = document.getElementById('perfil');
var info = document.getElementById('informacoes');

perfil.addEventListener('mouseover', function() {
    info.style.display = 'block';
  });


perfil.addEventListener('mouseout', function() {
    info.style.display = 'none';
  });