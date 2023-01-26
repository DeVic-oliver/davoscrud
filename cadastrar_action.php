<?php
require 'includes/header.php';
require 'config.php';

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_VALIDATE_INT);

$situacao = filter_input(INPUT_POST, 'situacao');
$mensalidade = filter_input(INPUT_POST, 'mensalidade');

$senha = filter_input(INPUT_POST, 'senha');

// $observacao = filter_input(INPUT_POST, 'observacao');


if($nome && $email && $telefone && $senha){

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();
    
    if($sql->rowCount() === 0){

        $sql = $pdo->prepare("INSERT INTO usuarios(nome, email, telefone, situacao, mensalidade, senha)  VALUES (:nome, :email, :telefone, :situacao, :mensalidade, :senha)");
        
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':telefone', $telefone);
        $sql->bindValue(':situacao', $situacao);
        $sql->bindValue(':mensalidade', $mensalidade);
        $sql->bindValue(':senha', $senha);
        // $sql->bindValue(':observacao', $observacao);
        $sql->execute();
        
        header("Location: index.php");
        exit;
    } else {
        header("Location: cadastrar.php");
    }
    
} else {
    header("Location: cadastrar.php");
}

    