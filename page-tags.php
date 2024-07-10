<?php
/* Template Name: Dynamic Post Tags Page */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <h1><?php the_title(); ?></h1>

        <?php
        // URLパラメータ 'post_id' から投稿IDを取得
        $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
        
        // 投稿が存在するか確認
        if ($post_id && get_post($post_id)) {
            // 特定の投稿を取得
            $post = get_post($post_id);
            setup_postdata($post);
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php
                    // 投稿に関連するタグを取得
                    $post_tags = get_the_tags();
                    if ($post_tags) {
                        echo '<div class="post-tags"><h3>Tags:</h3><ul>';
                        foreach ($post_tags as $tag) {
                            echo '<li><a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a></li>';
                        }
                        echo '</ul></div>';
                    } else {
                        echo '<p>No tags for this post.</p>';
                    }
                    ?>
                </div>
            </article>
            <?php
            wp_reset_postdata();
        } else {
            echo '<p>No post found or invalid post ID.</p>';
        }
        ?>
        
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
