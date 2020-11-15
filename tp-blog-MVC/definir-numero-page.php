<?php
//on définit le numéro de la page
if (isset($_GET['num_page']))
{
    $num_page = numeroPage($_GET['num_page']);
}
else
{
    $num_page = 1;
}