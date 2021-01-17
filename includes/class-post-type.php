<?php

namespace SimpleSlickSlider;

class Post_Type extends Registrator {

	const DEFAULT_NAME = 'slide';

	private $args = array(
		'hierarchical'        => false,
		'description'         => '',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 15,
		'menu_icon'           => 'dashicons-images-alt2',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'editor',
			// 'author',
			'thumbnail',
			'excerpt',
			// 'custom-fields',
			// 'trackbacks',
			// 'comments',
			// 'revisions',
			// 'page-attributes',
			// 'post-formats',
		),
	);

	private function get_labels() {
		return apply_filters(
			__CLASS__ . '::labels',
			array(
				'name'               => __( 'Слайды', 'project' ),
				'singular_name'      => __( 'Слайд', 'project' ),
				'add_new'            => __( 'Добавить слайд', 'project' ),
				'add_new_item'       => __( 'Добавить слайд', 'project' ),
				'edit_item'          => __( 'Редактировать слайд', 'project' ),
				'new_item'           => __( 'Новый слайд', 'project' ),
				'all_items'          => __( 'Все слайды', 'project' ),
				'view_item'          => __( 'Просмотр слайда на сайте', 'project' ),
				'search_items'       => __( 'Найти слайд', 'project' ),
				'not_found'          => __( 'Слайдов не найдено.', 'project' ),
				'not_found_in_trash' => __( 'В корзине нет слайдов.', 'project' ),
				'menu_name'          => __( 'Слайды', 'project' ),
			)
		);
	}

	public function register() {
		$this->args['labels'] = $this->get_labels();

		register_post_type( static::get_name(), $this->args );
	}
}
