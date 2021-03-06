<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca CEP</title>
</head>
<body>
    <h1>CEP - DEV Media</h1>
    <form method="get" action="service.php" id="frmBuscaCep">
            <input type="text" id="cep" placeholder="Informe seu CEP no formato 99999999" style="width:400px;" />
            
            <input type="submit" value="Buscar" />
            
            <p>Tipo logradouro: <input type="text" id="tipo" /></p>
            <p>Logradouro: <input type="text" id="logradouro" /></p>
            <p>Bairro: <input type="text" id="bairro" /></p>
            <p>Cidade: <input type="text" id="cidade" /></p>
            <p>Estado: <input type="text" id="estado" /></p>
            
            
            
            
        </form>
        
        <script src="jquery.js"></script>
        <script>
            $(function(){
                $("#frmBuscaCep").submit(function(event){
                    event.preventDefault();
                    
                   $.ajax({
                       url : "service.php?cep="+$("#cep").val(),
                       dataType : 'json'
                   }).done(function(data){
                        if(data.erro){
                            alert(data.message);   
                            
                            $("#cidade").val("");
                            $("#estado").val("");
                            $("#bairro").val("");
                            $("#logradouro").val("");
                            $("#tipo").val("");
                            
                        } else {
                            
                            
                            $("#cidade").val(data.dados.cidade);
                            $("#estado").val(data.dados.estado);
                            $("#bairro").val(data.dados.bairro);
                            $("#logradouro").val(data.dados.logradouro);
                            $("#tipo").val(data.dados.tipo_logradouro);
                            
                        }
                   });
                    
                });
            });
        </script>
</body>
</html>