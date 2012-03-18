<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */

//http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
function bootstrap_show_breadcrumb() {
    global $theme_config;

    return (
        $theme_config['show_breadcrumb'] > 0 && (
            $theme_config['show_breadcrumb'] == 1 || (
                $theme_config['show_breadcrumb'] == 2 &&
                !is_home() &&
                !is_front_page() ||
                is_paged()
            )
        )
    );
}

function bootstrap_breadcrumb() {
	global $post;

	if (bootstrap_show_breadcrumb()) {
        $entries = array(
            array(
                'title' => __('Home'),
                'link'  => get_bloginfo('url')
            )
        );

		if (is_category()) {
            $cat = get_the_category();

            usort($cat, function($a, $b) {
                $a = $a -> category_parent;
                $b = $b -> category_parent;

                return ($a < $b ? -1 : ($a == $b ? 0 : 1));
            });

            foreach($cat as $category) {
                $entries[] = array(
                    'title' => $category -> name,
                    'link'  => get_category_link($category->cat_ID)
                );

                if($category -> cat_ID == get_query_var('cat')) break;
            }

		} elseif(is_day()) {
            $entries[] = array(
                'title' => get_the_time('Y'),
                'link'  => get_year_link(get_the_time('Y'))
            );

            $entries[] = array(
                'title' => get_the_time('F'),
                'link'  => get_month_link(get_the_time('Y'), get_the_time('m'))
            );

            $entries[] = array(
                'title' => get_the_time('d'),
                'link'  => null
            );
		} elseif(is_month()) {
            $entries[] = array(
                'title' => get_the_time('Y'),
                'link'  => get_year_link(get_the_time('Y'))
            );

            $entries[] = array(
                'title' => get_the_time('F'),
                'link'  => get_month_link(get_the_time('Y'), get_the_time('m'))
            );

		} elseif(is_year()) {
			$entries[] = array(
                'title' => get_year_link(get_the_time('Y')),
                'link'  => get_the_time('Y')
            );
		} elseif(is_single() && !is_attachment()) {
			if(get_post_type() != 'post') {
				$post_type = get_post_type_object(get_post_type());

                $entries[] = array(
                    'title' => $post_type -> labels -> singular_name,
                    'link'  => sprintf('%s/%s', get_bloginfo('url'), $post_type->rewrite['slug'])
                );
			} else {
				$category = get_the_category();

                $entries[] = array(
                    'title' => $category[0] -> cat_name,
                    'link'  => get_category_link($category[0] -> term_id)
                );
			}

            $entries[] = array(
                'title' => get_the_title(),
                'link'  => get_post_permalink()
            );
		} elseif(!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());

            $entries[] = array(
                'title' => $post_type -> labels -> singular_name,
                'link'  => null
            );
		} elseif(is_attachment()) {
			$parent = get_post($post -> post_parent);
            $category = get_the_category($parent->ID);
            $category = $category[0];

            $entries[] = array(
                'title' => trim(get_category_parents($category, false), '/'),
                'link'  => null
            );

            $entries[] = array(
                'title' => $parent->post_title,
                'link'  => get_permalink($parent)
            );

            $entries[] = array(
                'title' => get_the_title(),
                'link'  => null
            );
		} elseif(is_page() && !$post -> post_parent) {
			$entries[] = array(
                'title' => get_the_title(),
                'link'  => null
            );
		} elseif (is_page() && $post -> post_parent) {
			$parent_id  = $post -> post_parent;

             while ($parent_id) {
                $page = get_page($parent_id);

                $entries[] = array(
                    'title' => get_the_title($page -> ID),
                    'link'  => get_permalink($page -> ID)
                );

                $parent_id  = $page -> post_parent;
			}

            $entries[] = array(
                'title' => get_the_title(),
                'link'  => null
            );
		} elseif(is_search()) {
            $entries[] = array(
                'title' => __(sprintf('Search results for %s', get_search_query()), 'wpbootstrap'),
                'link'  => null
            );
		} elseif(is_tag()) {
            $entries[] = array(
                'title' => __(sprintf('%s : %s', __('Tag', 'wpbootstrap'), single_tag_title('', false)), 'wpbootstrap'),
                'link'  => get_tag_link(get_query_var('tag_id'))
            );
		} elseif(is_author()) {
			global $author;

            $entries[] = array(
                'title' => __(sprintf('%s : %s', __('Author', 'wpbootstrap'), get_userdata($author) -> display_name), 'wpbootstrap'),
                'link'  => get_author_posts_url($author)
            );
		} elseif(is_404()) {
            $entries[] = array(
                'title' => __('Error 404', 'wpbootstrap'),
                'link'  => null
            );
		}

		if(($page = get_query_var('paged'))) {
			//if(is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';

            $entries[] = array(
                'title' => sprintf(__('Page %d', 'wpbootstrap'), $page),
                'link'  => null
            );
		}

        include get_template_directory() . '/header-breadcrumb.php';
	}
}
