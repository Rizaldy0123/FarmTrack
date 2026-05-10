<?php
$paper = array('Copier' => 'Copier & Multipurpose',
                'Inkjet' => "Inkjet Printer",
                'Laser' => "Laser Printer",
                'Photo' => "Photographic Printer");

while (list($item, $description) = each($paper)) {
    echo "$item : $description<br>";
}