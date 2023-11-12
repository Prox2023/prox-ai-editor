<?php
function prox_get_option( string $name, $default = false ) {
	$options = get_option( 'prox_options', array() );

	$value = $options[ $name ] ?? false;
	if ( $value === false && $default !== false ) {
		$value = $default;
	}

	if ( $value === 1 ) {
		$value = true;
	}

	return apply_filters( "prox_option_$name", $value, $name );
}
