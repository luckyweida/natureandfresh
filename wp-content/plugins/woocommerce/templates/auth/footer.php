@@ -67,11 +67,165 @@ foreach ($items as $item) {
</a>

<div class="menu-account col-md-4 col-xs-4">
	<a href="/sign-in">sign in</a>
	<div class="dropdown right-menu-item">
		<div class="dropdown-toggle" data-toggle="dropdown">
			cart
			<small>(<?php echo $count; ?>)</small>
			<span class="caret"></span>
		</div>
		<div class="cart-drop dropdown-menu" style="width: 30em;">
			<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<div class="" cellspacing="0">

					<?php
					do_action( 'woocommerce_before_cart_contents' );

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<div class="row">



								<div class="col-md-3">
									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo $thumbnail;
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
									}
									?>
								</div>

								<div class="col-md-7">
									<div class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
										<?php
										if ( ! $product_permalink ) {
											echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
										} else {
											echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
										}

										// Meta data
										echo WC()->cart->get_item_data( $cart_item );
										?>
									</div>

									<div class="row">
										<div class="col-md-3 product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
											<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'  => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
													'min_value'   => '0'
												), $_product, false );
											}

											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
											?>
										</div>

										<div class="col-md-9  product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
											x <?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
											?>
										</div>
									</div>
								</div>


								<div class="col-md-2">
									<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
									?>
								</div>
							</div>
							<?php
						}
					}

					do_action( 'woocommerce_cart_contents' );

					?>

					<div class="row">
						<div class="col-md-3">
							<a href="/cart/">View Cart</a>
						</div>

						<div class="col-md-3 col-md-offset-6">
							<input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Checkout', 'woocommerce' ); ?>" />
						</div>
					</div>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart' ); ?>
				</div>
				<?php do_action( 'woocommerce_after_cart_contents' ); ?>

				<?php do_action( 'woocommerce_after_cart_table' ); ?>

			</form>
		</div>

		<a href="/cart">cart
			<small>(<?php echo $count; ?>)</small>
		</a>

	</div>
	<div class="dropdown right-menu-item">
		<?php if (is_user_logged_in()) { ?>
			<a href="/my-account/">My Account</a>


		<?php } else { ?>
			<div class="dropdown-toggle" data-toggle="dropdown">
				sign in
				<span class="caret"></span>
			</div>
			<div class="cart-drop dropdown-menu" style="width: 30em;">
				<form method="post" class="login">

					<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
						<label for="username">Username or email address <span class="required">*</span></label>
						<input class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="" type="text">
					</p>
					<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
						<label for="password">Password <span class="required">*</span></label>
						<input class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="password" type="password">
					</p>


					<p class="form-row">
						<input id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="f0daa9bbcd" type="hidden"><input name="_wp_http_referer" value="/my-account/" type="hidden">				<input class="woocommerce-Button button" name="login" value="Login" type="submit">
						<label for="rememberme" class="inline">
							<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" id="rememberme" value="forever" type="checkbox"> Remember me				</label>
					</p>
					<p class="woocommerce-LostPassword lost_password">
						<a href="http://localhost:3007/my-account/lost-password/">Lost your password?</a>
					</p>

				</form>
			</div>
		<?php } ?>
	</div>
</div>
</header>
