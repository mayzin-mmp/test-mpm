<?php
/**
 * Template Name: Team Page Template
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rara_Business
 */
$sidebar_layout = rara_business_sidebar_layout();
get_header(); ?>
<style>
  .full-width #content .content-grid{
    max-width: 1140px;
      margin: 0 auto; 
}
.our-team{
  background: #fff;
  border-top: none; 
  border-bottom: none;
  padding:20px 0; 
}
.img-size{
  width:330px;
  height:250px;
}
</style>
  <div id="primary" class="content-area">
    <main id="main" class="site-main container-fluid">
      <header class="page-header">
        <?php  
            if ( have_posts() ) {
             while ( have_posts() ) { 
              the_post();
              the_content();
              } 
              }else{
                echo "<p>Please add Text.</p>";
              }?>
      </header>
      <section id="team-section" class="our-team wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
      <div class="container">
        <div class="grid">
          <?php
          $args = array (
            'post_type' => 'post',
            'category_name'   => 'teams',
            'posts_per_page' => 6,
            'shoposts' => 6,
            'paged' => $paged
            );
      // The Query

          $wp_query = new WP_Query( $args );
          $id = get_the_ID();
          if ($wp_query -> have_posts() ) {  /* Start the Loop */
            while ($wp_query->have_posts() ){
             the_post();
              ?>
              <section id="rrtc_description_widget-<?php echo $id ;?>" class="widget widget_rrtc_description_widget">
              <div class="rtc-team-holder">
                <div class="rtc-team-inner-holder">
                  <div class="image-holder">
                    <?php
                      if( has_post_thumbnail() ){
                          the_post_thumbnail('',array('class' => 'img-fluid img-size'));
                      }else{ ?>
                          <img src="<?php echo esc_url( get_template_directory_uri() . '/images/rara-business-blog.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid img-size" />
                      <?php 
                      }
                    ?>
                  </div>
                  <div class="text-holder">
                    <span class="name"><?php the_title();?></span>
                    <span class="designation">
                      <?php
                      if( has_excerpt() ){
                          the_excerpt();
                      }else{ ?>
                          <span class="text-warning">Please Fill Designation.</span>
                      <?php 
                      }
                    ?>
                      </span>
                    <div class="description">
                        <?php the_content(); ?>
                    </div>
                  </div>
                  <ul class="social-profile"> 
                    <li class="list-inline-item"><a href="http://facebook.com" 
                      target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="http://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="http://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                    <li class="list-inline-item"><a href="http://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="http://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a></li>
                  </ul>
                </div>
              </div><!-- #rtc-team-holder -->
           </section><!-- #rrtc_description_widget-3 -->

              <?php
            }
            ?>
         <div class="d-flex p-2 bd-highlight">
           
         
        <?php
          /**
           * @hooked rara_business_pagination
          */
          do_action( 'rara_business_after_posts_content' );
       
        ?>
        </div>  
        <?php

             }else {

              get_template_part( 'template-parts/content', 'none' );

            }
             wp_reset_postdata();
            ?>
          </div><!-- .grid -->
        </div>
      </section><!-- .team-section -->
      
    </main><!-- #main -->
        
  </div><!-- #primary -->

<?php
if ( 'full-width' != $sidebar_layout )
get_sidebar();
get_footer();