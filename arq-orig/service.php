<?php

    header('Content-Type: application/json');
    
    // receber por get uma variavel chamada CEP, do tipo integer 99999999
    // verificar se é um integer
    $cep = "";
    if(isset($_GET['cep'])){
        $cep = (int)$_GET['cep'];
    }
        
    $response = array();

    if($cep == ""){
        $response["erro"] = true;
        $response["message"] = "O CEP informado não parece ser correto!";
        
        echo json_encode($response);
        exit;
    }
    
    require'Db.php';
    $db = new Db;

    $ret = $db->query(sprintf("SELECT 
                                ende.cep, 
                                ende.logradouro, 
                                ende.tipo_logradouro,
                                ende.complemento,
                                cid.id_cidade,
                                cid.cidade,
                                bar.id_bairro,
                                bar.bairro,
                                est.uf,
                                est.estado
                               FROM 
                                cepbr_endereco ende,
                                cepbr_cidade cid,
                                cepbr_bairro bar,
                                cepbr_estado est
                               WHERE 
                                ende.id_cidade = cid.id_cidade AND
                                ende.id_bairro = bar.id_bairro AND
                                cid.uf = est.uf AND
                                cep = %s", $cep));

    if($ret->num_rows > 0){
        
        $dados = $ret->fetch_assoc();
        $response["erro"] = false;
        $response["dados"] = $dados;
        
        echo json_encode($response);
        
    } else {
        $response["erro"] = true;
        $response["message"] = "O CEP não foi localizado!";
        
        echo json_encode($response);
    }