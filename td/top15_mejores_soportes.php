<?php

$database['user'] = "matiasb_3756";
$database['pass'] = "A20!j2FOP1G3";
$database['host'] = "45.235.98.50";
$database['db'] = "matiasb_towerdefense";
$database['tabla'] = "td_users";

@$db = new mysqli($database['host'], $database['user'], $database['pass'], $database['db']);
if($db->connect_error) {
    die('Error de Conexi&oacute;n: <strong>[ '.$db->connect_errno.' ] (<span style="color:red"> '.$db->connect_error.' </span>)</strong>');
}

$max = 15;
$query = $db->query('SELECT * FROM '.$database['tabla']) or die ("Error: ".mysqli_error($db));
if(count($query->fetch_array(MYSQLI_NUM))) {
    echo '<html><head><title>TOP '.$max.' DE SOPORTE</title></head><body bgcolor="#212121"><table border="0" cellpadding="5" cellspacing="0" style="box-shadow: 0px 0px 8px white; border-radius: 5px; width: 100%;min-width: 50%;">
            <tbody style="text-align:center;color:white;">
                <tr style="font-weight: bold;background-color: black;">
                    <td>
                        RANK
                    </td>
                    <td>
                        NOMBRE
                    </td>
                    <td>
                        DAÑO DE SOPORTE
                    </td>
                </tr>';
                $n = 1;
                $query = $db->query('SELECT name, support_dmg FROM `'.$database['tabla'].'` ORDER BY support_dmg DESC, name ASC LIMIT 0,'.$max) or die ("Error en la consulta: ".mysqli_error($db));
                $style1 = "color: rgb(255, 225, 0);text-shadow: 0px 0px 4px rgb(255, 108, 0);";
                $style_c1 = "background-color: rgb(60, 60, 60);";
                $style_c2 = "background-color: rgb(48, 48, 48);";
                $style=1;
                $css = "";
                while($top = $query->fetch_array(MYSQLI_ASSOC)) {
                    
                    if($n == 1) {
                        $css = 'style="'.$style_c1.$style1.'"';
                        $style = 0;
                    }
                    else if($style) {
                        $css = 'style="'.$style_c1.'"';
                        $style=0;
                    }
                    else {
                        
                        $css = 'style="'.$style_c2.'"';
                        $style=1;
                    }
                    echo '<tr '.$css.'>
                    <td>'.
                        $n
                    .'</td>
                    <td>'.
                        $top['name']
                    .'</td>
                    <td>'.
                        $top['support_dmg']
                    .'</td>
                </tr>';
                    $n++;
                }
                echo '</tbody></table></body></html>';
    
}
else {
    echo "No hay datos que mostrar :(";
}
$query->free();

$db->close();
?>