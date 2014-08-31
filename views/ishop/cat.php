<?php defined('ISHOP') or die('Access denied'); ?>
<div class="catalog-index">

    <div class="kroshka">
        <a href="#">Мобильные телефоны</a> /
        <a href="#">LG</a> /
        <span>Слайдеры</span>
    </div> <!--.kroshka-->

    <div class="vid-sort">
        Вид:
        <a href="#"><img src="<?=TEMPLATE;?>images/vid-tabl.gif" title="Табличный вид" alt="Табличный вид"/></a>
        <a href="#"><img src="<?=TEMPLATE;?>images/vid-line.gif" title="Линейный вид" alt="Линейный вид"/></a>
        &nbsp;&nbsp;
        Сортировка по:&nbsp;
        <a href="#" class="sort-top-act">цене</a> &nbsp; | &nbsp;
        <a href="#" class="sort-top">названию</a> &nbsp; | &nbsp;
        <a href="#" class="sort-bot">добавления</a>
    </div> <!--.vid-sort-->

    <?php if($products): ?>
    <?php foreach($products as $product): ?>
    <div class="product-table">
        <h2><a href="?viev=product&goods_id=<?=$product['goods_id'];?>"><?=$product['name'];?></a></h2>
        <div class="product-table-img-main">
            <div class="product-table-img">
                <a href="?viev=product&goods_id=<?=$product['goods_id'];?>"><img src="<?=TEMPLATE;?>images/<?=$product['img'];?>" width="64" alt=""/></a>

                <div>
                    <img src="<?=TEMPLATE;?>images/ico-line-new.jpg" alt="новинка"/>
                    <img src="<?=TEMPLATE;?>images/ico-line-lider.jpg" alt="лидер"/>
                </div>
            </div>
        </div>
        <p class="cat-table-more"><a href="?viev=product&goods_id=<?=$product['goods_id'];?>">подробнее...</a></p>
        <p>Цена : <span><?=$product['price'];?></span></p>
        <a href="?view=addtocart&goods_id=<?=$product['goods_id'];?>"><img class="addtocard-index" src="<?=TEMPLATE;?>images/addcard-table.jpg" alt="Добавить в корзину"/></a>
    </div> <!--.product-table-->
    <?php endforeach; ?>
    <?php else: ?>
        <p>Здесь товаров пока нет!</p>
    <?php endif; ?>

</div>