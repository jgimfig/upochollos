<div id="anuncios">
    <h2>Patrocinado por:</h2>
<?php
$q="select contenido_multimedia from anuncio";
$anuncios= consulta($q);
for($i=0;$i<count($anuncios);$i++){
    echo "<img src='../img/anuncios/".$anuncios[$i][0]."'/>";
}
?>
</div>