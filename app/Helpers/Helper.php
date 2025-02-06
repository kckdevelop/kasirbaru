<?php
function formatRupiah($nominal){
    return "Rp ".number_format($nominal,2,',','.');
}

function hapusformat($nominal){

    $nilai = preg_replace('/[Rp. ]/','',$nominal);
    return $nilai;
}

