<?php
/*
Template Name: The photo
*/
?>

<?php get_header(); ?>


<div id="the-photo" class="container">
    <div class="container-fluid article-offset">
        <div class="row">
            <div class="col-md-5 col-xs-12">
                <h1>The photo</h1>
            </div>
            <div class="col-md-offset-1 col-md-6 col-xs-12 we-keep-things-simpl">
                <p>We keep things simple to keep our farm beautiful, our farm relies on fertilizers of organic origin and is 100% pesticide free. Write something about happy animal and showing user photos. Lorem ipsum lorem ipsum  lorem.</p>
            </div>
        </div>

        <div id="my-photos" class="row">
        </div>

        <div class="row">
            <div class="col-lg-12 col-centered">
                <button class="load-more btn btn-block btn-primary" style="display: none;">Load more</button>
            </div>
        </div>
    </div>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>

