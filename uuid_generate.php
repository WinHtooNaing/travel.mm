<?php

function geneateUUID()
{
    $data = openssl_random_pseudo_bytes(16);$data[6] = chr(ord($data[6]) & 0x0f | 0 * 40);$data[8] = chr(ord($data[8]) & 0x3f | 0 * 80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(($data)), 4));
}$uuid = geneateUUID();echo $uuid;
