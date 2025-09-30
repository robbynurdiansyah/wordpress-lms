<?php
/**
 * Content Generation API class
 *
 * Handles content generation related REST API endpoints.
 *
 * @package SureRank\Inc\Modules\Content_Generation
 * @since x.x.x
 */

namespace SureRank\Inc\Modules\Content_Generation;

use SureRank\Inc\Functions\Send_Json;
use SureRank\Inc\Traits\Get_Instance;
use SureRank\Inc\API\Api_Base;
use WP_REST_Request;
use WP_REST_Server;
use WP_Post;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Api
 *
 * Handles content generation related REST API endpoints.
 */
class Api extends Api_Base {
	use Get_Instance;

	/**
	 * Content Generation Controller instance.
	 *
	 * @var Controller
	 * @since x.x.x
	 */
	private $controller;

	/**
	 * Constructor
	 *
	 * @since x.x.x
	 */
	public function __construct() {
		parent::__construct();
		$this->controller = Controller::get_instance();
	}

	/**
	 * Register API routes.
	 *
	 * @since x.x.x
	 * @return void
	 */
	public function register_routes() {
		$this->register_content_generation_route();
	}

	/**
	 * Register index route.
	 *
	 * @since x.x.x
	 * @return void
	 */
	private function register_content_generation_route() {
		register_rest_route(
			$this->get_api_namespace(),
			'generate-content',
			[
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => [ $this, 'generate_content' ],
				'permission_callback' => [ $this, 'validate_permission' ],
				'args'                => [
					'post_id' => [
						'required'          => false,
						'type'              => 'integer',
						'sanitize_callback' => 'absint',
						'description'       => __( 'Post ID whose content needs to be generated (optional)', 'surerank' ),
					],
					'type'    => [
						'required'          => true,
						'type'              => 'string',
						'enum'              => Utils::get_instance()->get_api_types(),
						'sanitize_callback' => 'sanitize_text_field',
						'description'       => __( 'Type of content to generate: page title, page description, social title, social description', 'surerank' ),
						'default'           => 'page_title',
					],
				],
			]
		);
	}

	/**
	 * Generate content for a post.
	 *
	 * @since x.x.x
	 * @param WP_REST_Request<array<string, mixed>> $request Request object.
	 * @return void
	 */
	public function generate_content( $request ) {
		$post_id = $request->get_param( 'post_id' );
		$type    = $request->get_param( 'type' );

		if ( ! in_array( $type, Utils::get_instance()->get_api_types(), true ) ) {
			Send_Json::error(
				[
					'message'     => __( 'Invalid Content Type', 'surerank' ),
					/* translators: %1$s: Valid content types */
					'description' => sprintf( __( 'The content type needs to be one of these types: "%1$s"', 'surerank' ), implode( ', ', Utils::get_instance()->get_api_types() ) ),
					'code'        => 'invalid_content_type',
				]
			);
		}

		$post_title = '';

		// If post_id is provided, validate it and get post title.
		if ( ! empty( $post_id ) ) {
			$post = get_post( $post_id );

			if ( ! $post || ! $post instanceof WP_Post ) {
				Send_Json::error(
					[
						'message'     => __( 'Invalid post ID', 'surerank' ),
						'description' => __( 'Invalid post ID', 'surerank' ),
						'code'        => 'invalid_post_id',
					]
				);
			}

			$post_title = get_the_title( $post_id );
		}

		$site_name    = get_bloginfo( 'name' );
		$site_tagline = get_bloginfo( 'description' );

		$inputs = [
			'site_name'    => $site_name,
			'site_tagline' => $site_tagline,
			'page_title'   => $post_title,
		];

		$content = $this->controller->generate_content( $inputs, $type );

		if ( is_wp_error( $content ) ) {
			Send_Json::error(
				[
					'message'     => $content->get_error_message(),
					'description' => $content->get_error_message(),
					'code'        => $content->get_error_code(),
				]
			);
		}

		Send_Json::success(
			[
				'content' => $content,
			] 
		);
	}
}
