var pagina = 0;
var categoria = 1;
var texto = "";

function cargar() {
    $.ajax({
        url: "productos_paginados.php",
        data: {
            catId: categoria,
            pag: pagina,
            texto: texto
        },
        dataType: "html"
    }).done(function (html) {
        console.log("etapa 1");
        $("#productos").html(html);
        
        console.log("etapa 2");
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

$(document).ready(function(){
    $(".consolas-filtro").click(function(){
        categoria = $(this).attr('catId');
        $pagina = 0;
        cargar();
    });
    
    $("#buscar").click(function () {
        texto = $("#texto").val();
        pagina = 0
        cargar();
    });
    
    $("texto").on('keyup', function () {
        texto = $("texto").val();
        pagina = 0;
        cargar();
    });
    
    console.log("aaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
    
    cargar();
});