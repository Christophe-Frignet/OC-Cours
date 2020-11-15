<section class="">
    <p style="text-align: center;">
        <?php 
        $num = 1;
        for ($pag = 1; $pag <= $nbr_pages; $pag++)
        {
        ?>
        <a href="?num_page=<?=$num;?>">| Page <?=$num;?> |</a>

        <?php $num = $num + 1;
        }
        ?>
    </p> 
</section>
