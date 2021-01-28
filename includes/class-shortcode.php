<?php

namespace SimpleSlickSlider;

class Shortcode {

	const DEFAULT_NAME = 'slider';

	private $args = array(
		'id'   => 0,
		'size' => 'full',
	);

	public static function get_name() {
		 return apply_filters( __CLASS__ . '::name', static::DEFAULT_NAME );
	}

	public function register( $atts = array() ) {
		$atts = shortcode_atts(
			$this->args,
			$atts,
			Taxonomy::get_name()
		);

		if ( ! $atts['id'] = intval( $atts['id'] ) ) {
			return '';
		}

		$query = new \WP_Query(
			array(
				// Type & Status query args.
				'post_type'      => Post_Type::get_name(),
				'post_status'    => 'publish',

				// Order & Orderby query args.
				'order'          => 'ASC',
				'orderby'        => 'date',

				// Disable pagination.
				'posts_per_page' => - 1,

				// Taxonomy query args.
				'tax_query'      => array(
					'taxonomy'         => Taxonomy::get_name(),
					'field'            => 'id',
					'terms'            => array( $atts['id'] ),
					'include_children' => false,
					'operator'         => 'IN',
				),
			)
		);

		ob_start();
		if ( $query->have_posts() ) {
			// Start slides wrapper.
			printf( '<div id="slider_%d" class="row justify-content-between slider">', $atts['id'] );

			while ( $query->have_posts() ) {
				$query->the_post();

				?>
				<div class="col">
					<?php echo get_the_post_thumbnail( get_the_ID(), $atts['size'], $attr = '' ); ?>
				</div>
				<?php
			}

			// End slides wrapper.
			printf( '</div><!-- #slider_%d -->', $atts['id'] );
		}
		wp_reset_postdata();
		return ob_get_clean();
	}

	public function how_to_use_field( $actions, $tag ) {
		$shortcode_string = sprintf(
			'[%s id="%d"]',
			$this->get_name(),
			intval( $tag->term_id )
		);

		?>
		<div class="form-field">
			<input type="text" onclick="this.select()" value="<?php echo esc_attr( $shortcode_string ); ?> ">
		</div>
		<?php

		return $actions;
	}
}
