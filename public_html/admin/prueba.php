<?php
    require_once('../ormnv/include.php');
    $u = UsersQuery::create()->findOneByEmail("charly@nviame.com");
    echo $u->toJSON();
?>