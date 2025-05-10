<?php

$method = $_SERVER['REQUEST_METHOD'];

//NÃO FUNCIONOU!
//Funcionou depois de excluir o apache do pc E apagar o diretório sudo rm -rf /etc/apache2 /var/www/html /var/log/apache2 que estava gerando conflito
if($method !== 'POST'){
    header('Location: /pages/problems');
    exit;
}

//pegando o 'problem' de <input type="text" name="problem[title]" em new.phtml
//$_POST - data from HTML form is submitted/collected using this global variable. This method sends the encoded info embedded in the body of the http request
$problem = $_POST['problem'];
$title = $problem['title'];

$errors = [];

if(empty($title)){
    $errors['title'] = 'Testando!';
}

if(empty($errors)){
    //local onde vamos salvar o nosso title do problema
    //define() define uma constante
    define('DB_PATH', '/var/www/database/problems.txt');

    //salvando os dados
    //ele não cria o problems.txt, apenas o adiciona no fim do documento que já deve existir previamente
    file_put_contents(DB_PATH, $title . PHP_EOL, FILE_APPEND);

    header('Location: /pages/problems');
    exit;
} else {
    $title = 'Novo Problema';
    $view = '/var/www/app/views/problems/new.phtml';
    require '/var/www/app/views/layouts/application.phtml';
}