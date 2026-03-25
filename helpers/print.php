<?php

function printAll($obj){
    if(is_array($obj)){
        return print_r($obj);
    }

    echo $obj;
}