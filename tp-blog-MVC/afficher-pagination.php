<section class="">
    <p style="text-align: center;">
        <?php 
        $num = 1;
        for ($pag = 1; $pag <= $nbr_pages; $pag++)
        {
        ?>
        <a href="?num_page=<?php echo $num;?>">| Page <?php echo $num;?> |</a>

        <?php $num = $num + 1;
        }
        ?>
    </p> 
</section>
