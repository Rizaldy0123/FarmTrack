<?php
$paper = array('Copier' => 'Copier & Multipurpose',
               'Inkjet' => "Inkjet Printer",
               'Laser' => "Laser Printer",
               'Photo' => "Photographic Printer");

foreach ($paper as $item => $description) 
    echo "$item : $description<br>";
?>