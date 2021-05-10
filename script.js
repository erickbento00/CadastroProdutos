$(document).ready(function(){
    listaProdutos();
    if(GetURLParameter('codigo')){
        carregaProduto(GetURLParameter('codigo'));
    }
});


function carregaProduto(){
    $.post("editarProd.php",
    {
        operador: 'buscar',
        codigo: GetURLParameter('codigo')
    },
    function(data){
        meuObj = JSON.parse(data);
        $('#descricao').val(meuObj[0].descricao_prod),
        $('#categoria').val(meuObj[0].tipo_prod),
        $('#preco').val(meuObj[0].valor_uni),
        $('#quantidade').val(meuObj[0].quant_prod),
        $('#observacao').val(meuObj[0].obs_prod);
    });
};

function apagarProduto(codigo){
    $.post("editarProd.php",
    {
        operador: 'excluir',
        codigo: codigo
    },
    function(data){
        listaProdutos();
    });
};

$(".botaoPesquisa").click(function(){
    listaProdutos();
});

$(".botaoFiltroCategoria").click(function() {
    listaProdutos();
});

$(".edita").click(function(){
    $.post("editarProd.php",
    {
        operador: 'atualizar',
        codigo: GetURLParameter('codigo'),
        descricao: $('#descricao').val(),
        categoria: $('#categoria').val(),
        preco: $('#preco').val(),
        quantidade: $('#quantidade').val(),
        observacao: $('#observacao').val(),
    },
    function(data){
        listaProdutos();
        alert(data);
    });
});

$(".botao").click(function(){
    $.post("cadastroProd.php",
    {
        descricao: $('#descricao').val(),
        categoria: $('#categoria').val(),
        preco: $('#preco').val(),
        quantidade: $('#quantidade').val(),
        observacao: $('#observacao').val(),
    },
    function(data){
        listaProdutos();
        alert(data);
    });
});

function listaProdutos(){
    txt = "";
    $.post("filtroProd.php",
    {
        filtroCategoria: $('#FiltroCategoria').val(),
        pesquisa: $('#pesquisa').val(),
    },
    function(data){
        if (document.getElementById("demo")){
            meuObj = JSON.parse(data);
            txt += "<table>";
            txt += "<tr><th>" + "Código" + "</th>" + "<th>" + "Descrição" + "</th>"
            + "<th>" + "Categoria" + "</th>" + "<th>" + "R$ Valor" + "</th>"
            + "<th>" + "Estoque" + "</th>" + "<th>" + "Observão" + "</th></tr>";
            for (x in meuObj) {
            txt += "<tr><td>" + meuObj[x].cod_prod + "</td>"
            + "<td>" + meuObj[x].descricao_prod + "</td>"
            + "<td>" + meuObj[x].tipo_prod + "</td>"
            + "<td>" + meuObj[x].valor_uni + "</td>"
            + "<td>" + meuObj[x].quant_prod + "</td>"
            + "<td>" + meuObj[x].obs_prod + "</td>"
            + "<td><a href='editarCadastro.html?codigo=" + meuObj[x].cod_prod + "'>" + "Editar" + "</a></td>"
            + "<td><input type='button' onclick='apagarProduto(" + meuObj[x].cod_prod + ");' value='Excluir'></input></td></tr>";
            };
            txt += "</table>"
            document.getElementById("demo").innerHTML = txt;
            }
        },
    );
};

function GetURLParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}
