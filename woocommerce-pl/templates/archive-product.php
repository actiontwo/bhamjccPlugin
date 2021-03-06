<?php

/**

 * The Template for displaying product archives, including the main shop page which is a post type archive.

 *

 * Override this template by copying it to yourtheme/woocommerce/archive-product.php

 *

 * @author 		WooThemes

 * @package 	WooCommerce/Templates

 * @version     2.0.0

 */



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



get_template_part( 'templates/header' ); ?>



	    

     



<section class="wellness">

<div class="container">

<div class="row">

                

                

                <div class="col-md-9">

                    	<div class="wellness_boxes">

                        	<h1>Easy to Join Today</h1>

                            <div class="row">

                 	

                

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>





		<?php endif; ?>



		<?php do_action( 'woocommerce_archive_description' ); ?>



		<?php if ( have_posts() ) : ?>





			<?php woocommerce_product_loop_start(); ?>



				<?php woocommerce_product_subcategories(); ?>



				<?php while ( have_posts() ) : the_post(); ?>



					<?php wc_get_template_part( 'content', 'product' ); ?>



				<?php endwhile; // end of the loop. ?>



			<?php woocommerce_product_loop_end(); ?>



			<?php

				/**

				 * woocommerce_after_shop_loop hook

				 *

				 * @hooked woocommerce_pagination - 10

				 */

				do_action( 'woocommerce_after_shop_loop' );

			?>



		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>



			<?php wc_get_template( 'loop/no-products-found.php' ); ?>



		<?php endif; ?>







</div>



                        </div>

                        

                    </div>

                    

                    

            <div class="col-md-3">

                    	<div class="side_bar join_side_bar">

                            <!-- Accordion begin -->

                            <div class="accordion_example2">

                                <!-- Section 1 -->

                                <div class="accordion_in acc_active">

                                    <div class="acc_head"><h3>Join Today</h3></div>

                                    <div class="acc_content">

                                    	<ul>

                                        	<li><a href="#">Membership Type</a></li>

                                        	<li><a href="#">Camps</a></li>

                                            <li><a href="#">Membership Offers</a></li>

                                        </ul>

                                  	</div>

                                </div>

                                <!-- End Section 1 -->

                            </div>

                            <!-- Accordion end -->

                            

                            <!-- Contact Form -->

                            <div class="side_contact_form">

                            	<div class="form_heading">

                                    <h3> CONTACT US </h3>

                                    <h6>FOR IMMEDIATE RESPONSE:</h6>

                                </div>

                                    

                                <?php echo do_shortcode( '[contact-form-7 id="105" title="Contact Form Shop Products Page"]' ); ?>

                            </div>

                            <!-- End Contact Form -->

                        </div>

                    </div>    

                



</div>

</div>

</section>



<?php get_template_part( 'templates/footer'); ?>