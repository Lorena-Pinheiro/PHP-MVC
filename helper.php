<?php
function view( $view, array $data = [] ) {
    $file = __DIR__ . "/$view.php";

    if ( !file_exists( $file ) ) {
        throw new Exception("error");
    }

    extract($data);
    ob_start();
    include $file;
    $conteudo = ob_get_clean();

    include __DIR__ ."/layout.php";
}