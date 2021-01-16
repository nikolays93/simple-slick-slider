<?php

class Taxonomy implements Registrator {

	const DEFAULT_NAME = 'slider';

	private $args = array(
		'hierarchical' => false,
		'show_ui'      => true,
		'query_var'    => true,
	)

	public static function get_name() {
		 return apply_filters( __CLASS__ . '::name', static::DEFAULT_NAME );
	}

	private function get_labels() {
		return apply_filters(
			__CLASS__ . '::labels',
			array(
				'name'                       => __( 'Слайдер', 'project' ),
				'singular_name'              => __( 'Слайдер', 'project' ),
				'search_items'               => __( 'Найти слайдер', 'project' ),
				'popular_items'              => __( 'Популярные слайдеры', 'project' ),
				'all_items'                  => __( 'Все слайдеры', 'project' ),
				'edit_item'                  => __( 'Изменить слайдер', 'project' ),
				'update_item'                => __( 'Обновить слайдер', 'project' ),
				'add_new_item'               => __( 'Добавить новый слайдер', 'project' ),
				'new_item_name'              => __( 'Новое имя слайдера', 'project' ),
				'separate_items_with_commas' => __( 'Введите слайдеры через запятую', 'project' ),
				'add_or_remove_items'        => __( 'Добавить или удалить слайдер', 'project' ),
				'choose_from_most_used'      => __( 'Выберите из популярных', 'project' ),
				'menu_name'                  => __( 'Слайдер', 'project' ),
			)
		);
	}

	public function register() {
		$this->args['labels'] = $this->get_labels();

		register_taxonomy(
			static::get_name(),
			Post_Type::get_name(),
			$this->args
		);
	}
}
