<?php
function view( $view, array $data = [] ) {
    $file = __DIR__ . "/../views/$view.php";

    if ( !file_exists( $file ) ) {
        throw new Exception("View file not found: $file");
    }

    extract($data);
    ob_start();
    include $file;
    $conteudo = ob_get_clean();

    include __DIR__ ."/../views/layout.php";
}