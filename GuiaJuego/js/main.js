var pagina = 0;
var categoria = 1;
var texto = "";
var consola = 1;

function cargar() {
    $.ajax({
        url: "productos_paginados.php",
        data: {
            catId: categoria,
            pag: pagina,
            texto: texto,
            consola:consola
        },
        dataType: "html"
    }).done(function (html) {

        $("#productos").html(html);

        $("#anterior").click(function () {
            pagina -= 1;
            cargar();
        });

        $("#siguiente").click(function () {
            pagina += 1;
            cargar();
        });
    }).fail(function () {
        alert('Error');
    });
}

$(document).ready(function () {

    $("#consolas-filtro").change(function(){
        consola = $(this).val();
        pagina = 0;
        cargar();
    });

    $("#buscar").click(function () {
        texto = $("#texto").val();
        pagina = 0;
        cargar();
    });

    $('#genero-filtro').change(function () {
        categoria = $(this).val();
        pagina = 0;
        cargar();
    });

    $("texto").on('keyup', function () {
        texto = $("#texto").val();
        pagina = 0;
        cargar();
    });

    cargar();
});