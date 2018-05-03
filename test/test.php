<?php

function assertTrue($result){
    if(!$result){
        throw new Exception("assert false");
    }
    echo "Test passed!";
}