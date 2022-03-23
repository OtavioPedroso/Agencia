<?php
/*
  *
  * Template Name: Conteúdo
  *
 */

    get_header();
    require_once("assets/util/posts.php");

    $posts = new Posts(20, 0, 'post', (isset($_GET['pages'])? $_GET['pages'] : 1), null);
    $posts -> get_posts();
    $base_uri = get_page_link();
    $current_page = $posts->get_current_page();
?>
<section id="content" class="border-top border-primary">
    
        <div class="d-flex justify-content-center"> 
                    
            <div class="d-flex align-content-around flex-wrap mt-1 ">
            
            <?php if($posts->have_posts()): ?>

                <?php if($posts->is_first_page()):?>
                    <?php $posts->the_post();?>
                    <div id="card-content" class="card border border-warning mt-2 ms-2" >
                        <h4 class="card-header text-white bg-warning">
                            <?php $category = get_the_category(); ?>
                            <div class="categoria"><?php echo $category[0]->cat_name; ?>
                            <span class="badge bg-secondary">Novo</span>
                            </div>
                        </h4>
                        <div class="card-body bg-light text-black">
                            <h5 class="card-title"><?php the_title();?></h5>
                            <p class="card-text"><?php the_content();?></p>
                        </div>
                        <a class="card-footer btn btn-light text-decoration-none" href="<?php the_permalink();?>">Continue Lendo...</a>
                    </div>
                <?php endif; ?>
                
                <?php while($posts->have_posts()):$posts -> the_post();?>   
                    <div id="card-content" class="card border border-warning mt-2 ms-2" >
                        <h4 class="card-header text-white bg-warning">
                            <?php $category = get_the_category(); ?>
                            <div class="categoria"><?php echo $category[0]->cat_name; ?></div>
                        </h4>
                        <div class="card-body bg-light text-black">
                            <h5 class="card-title"><?php the_title();?></h5>
                            <p class="card-text"><?php the_content();?></p>
                        </div>
                        <a class="card-footer btn btn-light text-decoration-none" href="<?php the_permalink();?>">Continue Lendo...</a>
                    </div>
                <?php endwhile;?>
            <?php endif; ?>
            </div>
        </div>
</section>
<?php
    get_footer(); ?>