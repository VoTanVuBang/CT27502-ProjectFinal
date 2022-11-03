<?php
$menu_cartegory = $frontend->show_cartegory();
?>

<div class="cartegory-left">
    <ul>
        <?php
        if ($menu_cartegory) {
            foreach($menu_cartegory as $key => $cartegory) {
        ?>
                <li class="cartegory-left-li">
                    <a href="product_by_cartegory.php?cartegory_id=<?php echo $cartegory['cartegory_id'] ?>">
                        <?php echo ucwords($cartegory['cartegory_name'])  ?>
                    </a>
                </li>
        <?php
            }
        }
        ?>
    </ul>
</div>