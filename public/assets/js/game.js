$(document).ready(function () {
    $('table').click(comprobarPosicion);
});

function comprobarPosicion(e) {
    $('#mensaje').empty();
    var celda = e.target;
    if (celda.nodeName === 'TD' && (celda.innerHTML === "" || celda.innerHTML === "+")) {
        $.ajax({
            url: 'index.php',
            dataType: 'JSON',
            type: 'POST',
            data: {
                f: celda.dataset.x,
                c: celda.dataset.y
            },
            success: function (result) {
                if (result.fMovUsuario !== undefined) {
                    $(`#${result.fIniUsuario}${result.cIniUsuario}`).empty();
                    $(`#${result.fMovUsuario}${result.cMovUsuario}`).html("*");
                }
                if (result.fMovCPU !== undefined) {
                    $(`#${result.fIniCPU}${result.cIniCPU}`).empty();
                    $(`#${result.fMovCPU}${result.cMovCPU}`).html("+");
                }
                if (result.final !== undefined) {
                    switch (result.final) {
                        case 1:
                            $('#mensaje').html("¡HAS GANADO!");
                            break;
                        case - 1:
                            $('#mensaje').html("¡HAS PERDIDO!");
                            break;
                    }
                    $('table').unbind('click');
                }
                if (result.invalido !== undefined) {
                    $('#mensaje').html(result.invalido);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status + ' ' + textStatus);
            }
        });
    }
}
