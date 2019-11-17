<?php

require "simple_html_dom.php";

$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

$html = file_get_html('https://www.kqxs.vn/mien-nam', false, stream_context_create($arrContextOptions));

$noidung = $html->find('.miennam > table > tbody',0)->innertext;

echo '<table style="table-layout:fixed;text-align:center;" border="1" cellpadding="0" cellspacing="0">'.$noidung.'</table>';

?>