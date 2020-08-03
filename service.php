<?php 
   

    header('content-Type: application/json');

    $cep = "";
    if(isset($_GET['cep'])){
        $cep = (int) $_GET['cep'];
    } 

    

    $response = [];

    if($cep == ""){
        $response["erro"] = true;
        $response["message"] = "O CEP precisa ser informado.";

        echo json_encode($response);
        exit;
    }

    require "db.php";

    $db = new Db;

    $ret = $db->query(sprintf("SELECT 
                                    ender.cep, 
                                    ender.logradouro, 
                                    ender.tipo_logradouro,
                                    ender.complemento,
                                    cid.id_cidade,
                                    cid.cidade,
                                    bar.id_bairro,
                                    bar.bairro,
                                    est.uf,
                                    est.estado
                                FROM 
                                    cepbr_endereco ender,
                                    cepbr_cidade cid,
                                    cepbr_bairro bar,
                                    cepbr_estado est
                                WHERE 
                                    ender.id_cidade = cid.id_cidade AND
                                    ender.id_bairro = bar.id_bairro AND
                                    cid.uf = est.uf AND
                                    cep = %s", $cep));

    if ($ret->num_rows > 0) {
        $dados = $ret->fetch_assoc();
        $response["erro"] = false;
        $response["dados"] = $dados;

        echo json_encode($response);

    } else {
        $response["erro"] = true;
        $response["message"] = "O CEP informado não foi encontrado.";

        echo json_encode($response);
    }




