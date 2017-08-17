<?php
/*
Template Name: The photo
*/
?>

<?php get_header(); ?>


<div id="the-photo" class="container">

    <div class="row page-description">
        <div class="col-md-5 col-sm-12">
            <h4>The photo</h4>
        </div>
        <div class="col-md-7 col-sm-12">
            <?php /**
                <p class="text">We keep things simple to keep our farm beautiful, our farm relies on fertilizers of organic origin and is 100% pesticide free. Write something about happy animal and showing user photos. Lorem ipsum lorem ipsum  lorem.</p>
             */?>
            <p class="text"><?php echo get_field('intro_content'); ?></p>
        </div>
    </div>

    <div id="my-photos" class="row">
    </div>

    <div class="row">
        <div class="col-lg-12 text-center">
            <button class="load-more btn btn-sm" style="display: none;">Load more</button>
        </div>
    </div>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>

