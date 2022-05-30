<?php
/**
* Add CSV columns for exporting extra data.
*
* @param  array  $columns
                 * @return array  $columns
                                  */
function kia_add_columns( $columns ) {
	$columns[ 'brand' ] = __( 'Brands', 'your-text-domain' );
	return $columns;
}
add_filter( 'woocommerce_product_export_column_names', 'kia_add_columns' );
add_filter( 'woocommerce_product_export_product_default_columns', 'kia_add_columns' );


/**
 * MnM contents data column content.
 *
 * @param  mixed       $value
 * @param  WC_Product  $product
 * @return mixed       $value
 */
function kia_export_taxonomy( $value, $product ) {

	$terms = get_terms( array( 'object_ids' => $product->get_ID(), 'taxonomy' => 'brand' ) );

	if ( ! is_wp_error( $terms ) ) {

		$data = array();

		foreach ( (array) $terms as $term ) {
			$data[] = $term->term_id;
		}

		$value = join( ', '$data );

	}

	return $value;
}
add_filter( 'woocommerce_product_export_product_column_custom_taxonomy', 'kia_export_taxonomy', 10, 2 );



/**
 * Import
 */


/**
 * Register the 'Custom Column' column in the importer.
 *
 * @param  array  $columns
 * @return array  $columns
 */
function kia_map_columns( $columns ) {
	$columns[ 'brand' ] = __( 'Brands', 'your-text-domain' );
	return $columns;
}
add_filter( 'woocommerce_csv_product_import_mapping_options', 'kia_map_columns' );


/**
 * Add automatic mapping support for custom columns.
 *
 * @param  array  $columns
 * @return array  $columns
 */
function kia_add_columns_to_mapping_screen( $columns ) {

	$columns[ __( 'Brands', 'your-text-domain' ) ] 	= 'brand';

	// Always add English mappings.
	$columns[ 'Brands' ]	= 'brand';

	return $columns;
}
add_filter( 'woocommerce_csv_product_import_mapping_default_columns', 'kia_add_columns_to_mapping_screen' );


/**
 * Decode data items and parse JSON IDs.
 *
 * @param  array                    $parsed_data
 * @param  WC_Product_CSV_Importer  $importer
 * @return array
 */
function kia_parse_taxonomy_json( $parsed_data, $importer ) {

	if ( ! empty( $parsed_data[ 'brand' ] ) ) {

		$data = json_decode( $parsed_data[ 'brand' ], true );

		unset( $parsed_data[ 'brand' ] );

		if ( is_array( $data ) ) {

			$parsed_data[ 'brand' ] = array();

			foreach ( $data as $term_id ) {
				$parsed_data[ 'brand' ][] = $term_id;
			}
		}
	}

	return $parsed_data;
}
add_filter( 'woocommerce_product_importer_parsed_data', 'kia_parse_taxonomy_json', 10, 2 );


/**
 * Set taxonomy.
 *
 * @param  array  $parsed_data
 * @return array
 */
function kia_set_taxonomy( $product, $data ) {

	if ( is_a( $product, 'WC_Product' ) ) {

		if( ! empty( $data[ 'brand' ] ) ) {
			wp_set_object_terms( $product->get_id(),  (array) $data[ 'brand' ], 'brand' );
		}

	}

	return $product;
}
add_filter( 'woocommerce_product_import_inserted_product_object', 'kia_set_taxonomy', 10, 2 );