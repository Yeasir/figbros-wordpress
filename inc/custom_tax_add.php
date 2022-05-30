<?php
/**
 * Add the custom column to the exporter and the exporter column menu.
 *
 * @param array $columns
 * @return array $columns
 */
function add_export_column( $columns ) {

	// column slug => column name
	$columns['brand'] = 'Brands';

	return $columns;
}
add_filter( 'woocommerce_product_export_column_names', 'add_export_column' );
add_filter( 'woocommerce_product_export_product_default_columns', 'add_export_column' );

/**
 * Provide the data to be exported for one item in the column.
 *
 * @param mixed $value (default: '')
 * @param WC_Product $product
 * @return mixed $value - Should be in a format that can be output into a text file (string, numeric, etc).
 */
function add_export_data( $value, $product ) {

	$term_obj_list = get_the_terms( $product->get_id(), 'brand' );
	if ( ! is_wp_error( $term_obj_list ) ) {
		$value = join( ', ', wp_list_pluck( $term_obj_list, 'name' ) );
	}
	return $value;
}
// Filter you want to hook into will be: 'woocommerce_product_export_product_column_{$column_slug}'.
add_filter( 'woocommerce_product_export_product_column_brand', 'add_export_data', 10, 2 );




/**
 * Import feature
 */

/**
 * Register the 'Brands' column in the importer.
 *
 * @param array $options
 * @return array $options
 */
function add_column_to_importer( $options ) {

	// column slug => column name
	$options['brand'] = 'Brands';

	return $options;
}
add_filter( 'woocommerce_csv_product_import_mapping_options', 'add_column_to_importer' );

/**
 * Add automatic mapping support for 'Brands'.
 * This will automatically select the correct mapping for columns named 'Brands' or 'custom column'.
 *
 * @param array $columns
 * @return array $columns
 */
function add_column_to_mapping_screen( $columns ) {

	// potential column name => column slug
	$columns['Brands'] = 'brand';
	$columns['brands'] = 'brand';

	return $columns;
}
add_filter( 'woocommerce_csv_product_import_mapping_default_columns', 'add_column_to_mapping_screen' );

/**
 * Process the data read from the CSV file.
 * This just saves the value in meta data, but you can do anything you want here with the data.
 *
 * @param WC_Product $object - Product being imported or updated.
 * @param array $data - CSV data read for the product.
 */
function process_import( $object, $data ) {

	if ( ! empty( $data['brand'] ) ) {
		$brand_id = array();
		$brands = explode(',',  $data['brand']);
		foreach ($brands as $brand){
			$brand = trim($brand);
//			$brand = str_replace('&amp;', '&', $brand);
//			$brand = str_replace('&', '&amp;', $brand);
			$brand_data = get_term_by('name', $brand, 'brand');
			if(!is_wp_error($brand)){
				$brand_id[] = $brand_data->term_id;
			}
		}
		if(!empty($brand_id)) {
			wp_set_post_terms( $object->get_id(), $brand_id, 'brand' );
		}
	}

}
add_action( 'woocommerce_product_import_inserted_product_object', 'process_import', 10, 2 );


add_action('template_redirect', function(){
	if(isset($_GET['test1'])){
		/*$term_obj_list = get_the_terms( 33, 'brand' );
		$terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
		var_dump($terms_string);*/
		$brand_id = array();
		$brands = explode(',',  'Melinda’s');
		foreach ($brands as $brand){
			$brand = trim($brand);
			$brand_data = get_term_by('name', $brand, 'brand');
			if(!is_wp_error($brand)){
				$brand_id[] = $brand_data->term_id;
			}
		}
		if(!empty($brand_id)) {
			wp_set_post_terms( 983, $brand_id, 'brand' );
		}
		die();
	}
});