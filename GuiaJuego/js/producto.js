var texto = "";
var puntuacion = 0;
var intencionDeComentar = false;
var pagina = 0;
var prodId = 0;

function cargar() {
    $.ajax({
        url: "comentarios_paginados.php",
        data: {
            texto: texto,
            puntuacion: puntuacion,
            intencionDeComentar: intencionDeComentar,
            pag: pagina,
            prodId: prodId
        },
        dataType: "html"
    }).done(function (html) {
        
        $("#comentarios").html(html);

        $("#anterior").click(function () {
            pagina -= 1;
            prodId = $("#productoId").val();
            cargar();
        });

        $("#siguiente").click(function () {
            pagina += 1;
            prodId = $("#productoId").val();
            cargar();
        });
    }).fail(function () {
        alert('Error');
    });
}

$(document).ready(function () {
    $("#Enviar").click(function () {
        texto = $("#texto").val();
        puntuacion = $("#puntuacionJuego").val();
        console.log(puntuacion);
        console.log(texto);
        intencionDeComentar = true;
        cargar();
    });
    $('#productoId').hide();
    prodId = $("#productoId").val();
    cargar();
});