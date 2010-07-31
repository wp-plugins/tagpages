<?php

/*
Plugin Name: TagPages
Plugin URI: http://www.neotrinity.at/projects/
Description: Adds post-tags functionality for pages.
Author: Dr. Bernhard Riedl
Version: 1.10
Author URI: http://www.bernhard.riedl.name/
*/

/*
Copyright 2010 Dr. Bernhard Riedl

This program is free software:
you can redistribute it and/or modify
it under the terms of the
GNU General Public License as published by
the Free Software Foundation,
either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope
that it will be useful,
but WITHOUT ANY WARRANTY;
without even the implied warranty of
MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE.

See the GNU General Public License
for more details.

You should have received a copy of the
GNU General Public License
along with this program.

If not, see http://www.gnu.org/licenses/.
*/

/*
global instance
*/

global $tagpages;

if (empty($tagpages) || !is_object($tagpages) || !$tagpages instanceof TagPages)
	$tagpages=new TagPages();

/*
Class
*/

class TagPages {

	/*
	prefix for fields, options, etc.
	*/

	private $prefix='tagpages';

	/*
	nicename for options-page,
	meta-data, etc.
	*/

	private $nicename='TagPages';

	/*
	Constructor
	*/

	function __construct() {

		/*
		initialize object
		*/

		$this->register_hooks();
	}

	/*
	register WordPress hooks
	*/

	private function register_hooks() {

		/*
		As the initial taxonomies are
		registered twice in the
		WordPress Bootstrap, we have to
		register the function-call two times
		for the taxonomy 'post_tag'.
		*/

		add_action('plugins_loaded', array(&$this, 'add_page_to_tags_taxonomy'));
		add_action('init', array(&$this, 'create_initial_taxonomies_add_page_to_tags_taxonomy'), 0);

		/*
		The second call already
		exists for the init hook. So we gonna
		remove the hook and use the replacement
		from above instead
		*/

		remove_action('init', 'create_initial_taxonomies', 0);

		/*
		adds post_type 'page' to where-clause
		of tag-queries
		*/

		add_filter('posts_where', array(&$this, 'add_page_to_tags_where_clause'));

		/*
		add tags column and content
		in Pages section of Admin Menu
		*/

		add_filter('manage_pages_columns', array(&$this, 'manage_pages_columns'));
		add_filter('manage_pages_custom_column', array(&$this, 'manage_pages_custom_column'), 10, 3);

		/*
		adopt name of Posts column in
		Post Tags section of Admin Menu
		*/

		add_filter('manage_edit-post_tag_columns', array(&$this, 'manage_edit_post_tag_columns'));

		/*
		meta-data
		*/

		add_action('wp_head', array(&$this, 'head_meta'));
		add_action('admin_head', array(&$this, 'head_meta'));
	}

	/*
	GETTERS AND SETTERS
	*/

	/*
	getter for prefix
	true with trailing _
	false without trailing _
	*/

	function get_prefix($trailing_=true) {
		if ($trailing_)
			return $this->prefix.'_';
		else
			return $this->prefix;
	}

	/*
	getter for nicename
	*/

	function get_nicename() {
		return $this->nicename;
	}

	/*
	CALLED BY HOOKS
	(and therefore public)
	*/

	/*
	include the page as post_type for post-tags
	*/

	function add_page_to_tags_taxonomy() {
		register_taxonomy_for_object_type('post_tag', 'page');
	}

	/*
	expanded version of
	create_initial_taxonomies()
	in wp-includes/taxonomy.php
	*/

	function create_initial_taxonomies_add_page_to_tags_taxonomy() {
		create_initial_taxonomies();
		$this->add_page_to_tags_taxonomy();
	}

	/*
	add post_type 'page'
	to where statement of
	tag-queries

	taken from tags4page by Michele Marcucci
	http://www.michelem.org/wordpress-plugin-tags4page/
	*/

	function add_page_to_tags_where_clause($where) {
		if(is_tag()) {
			$where = preg_replace("/ ([0-9a-zA-Z_]*\.?)post_type = 'post'/", "(${1}post_type = 'post' OR ${1}post_type = 'page')", $where);
		}

		return $where;
	}

	/*
	WordPress seems to automatically
	create the Tags columns, but
	to assure it in future version,
	we also manually add the tags column
	to the Pages section of the Admin Menu
	*/

	function manage_pages_columns($columns) {
		$columns['tags']=__('Tags');
		return $columns;
	}

	/*
	echo tags to display in
	tags column in Pages section
	of Admin Menu

	based on function post_row
	in wp-admin/includes/template.php
	*/

	function manage_pages_custom_column($column_name, $page_id) {
		if ($column_name=='tags') {
			$tags = get_the_tags($page_id);

			if (!empty($tags)) {
				$out = array();

				foreach($tags as $c)
					$out[] = "<a href='edit.php?post_type=page&amp;tag={$c->slug}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'post_tag', 'display')) . '</a>';

				echo join(', ', $out);
			}

			else {
				_e('No Tags');
			}
		}
	}

	/*
	adopt the name the Posts column in
	the Post Tags section of the Admin Menu
	and give some tooltip-hint
	*/

	function manage_edit_post_tag_columns($columns) {
		$show=__('Posts');
		if (isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type']) && $_REQUEST['post_type']=='page')
			$show=__('Pages');

		$columns['posts']='<span title="'.sprintf(__('combined number of occurrences in %2$s and %3$s, but will only show %1$s'), __($show), __('Posts'), __('Pages')).'">'.__('Posts').' &amp; '.__('Pages').'</span>';
		return $columns;
	}

	/*
	adds meta-information to HTML header
	*/

	function head_meta() {
		echo("<meta name=\"".$this->get_nicename()."\" content=\"1.10\"/>\n");
	}

}

?>