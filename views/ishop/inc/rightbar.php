<?php defined('ISHOP') or die('Access denied'); ?>
<div id="right-bar">
			<div class="right-bar-cont">
				<div class="enter">
					<h2>Авторизация</h2>
					<div class="authform">
                        <?php if(!$_SESSION['auth']['user']): ?>
                            <form action="#" method="post">
                                <label for="login">Логин: </label><br/>
                                <input type="text" name="login" id="login"/><br/>
                                <label for="pass">Пароль: </label><br/>
                                <input type="password" id="pass" name="pass"/><br/><br/>
                                <input type="submit" name="auth" id="auth" value="Войти"/>

                                <p class="link"><a href="?view=reg">Регистрация</a></p>
                            </form>
                            <?php else: ?>
                                <p>Добро пожаловать, <?=$_SESSION['auth']['user'];?></p>
                                <a href="do=logout">Выход</a>
                        <?php endif; ?>
					</div>	
				</div> <!--.enter-->
				<div class="basket">
					<h2>Корзина</h2>
					<div>
                        <p>
                            <?php if($_SESSION['total_quantity']): ?>
                                Товаров в корзине: <br/>
                                <span><?=$_SESSION['total_quantity'];?></span> на сумму <span><?=$_SESSION['total_sum'];?></span> руб
                                <a href="#"><img src="<?=TEMPLATE?>images/oformit.jpg" alt="" /></a>
                                <?php else: ?>
                                    Корзина пуста
                            <?php endif; ?>
                        </p>
					</div>
				</div> <!--.basket-->
				<div class="share-search">
					<h2>Выбор по параметрам</h2>
					<div>
						<form method="post" action="">
						<p>Стоимость:</p>
						от <input class="podbor-price" type="text" name="start-price" />
						до <input class="podbor-price" type="text" name="stop-price" />
						 руб.
						 <br /><br />
						<p>Производители:</p>
						<select>
							<option>Ericsson</option>
							<option>Alcatel</option>
							<option>Mitsubish</option>
							<option>Motorola</option>
							<option>NEC</option>
							<option>Nokia</option>							
						</select>
						
						<input class="podbor" type="image" src="<?=TEMPLATE?>images/podbor.jpg" />						
						</form>
					</div>
				</div>	
			</div>
		</div>