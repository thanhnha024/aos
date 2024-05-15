<?php

namespace WPDesk\FCF\Free\Settings\Route;

use WPDesk\FCF\Free\Collections\RouteParamBag;

/**
 * Interface for REST API route.
 */
interface RouteInterface {

	/**
	 * Returns route of REST API endpoint.
	 *
	 * @return string Route name.
	 */
	public function get_endpoint_route(): string;

	/**
	 * Returns list of HTTP methods for endpoint.
	 *
	 * @return string[] List of methods.
	 */
	public function get_route_methods(): array;

	/**
	 * Returns list of args for params using to register endpoint.
	 *
	 * @return array Args for endpoint params.
	 */
	public function get_route_params(): array;

	/**
	 * Returns data to be returned for endpoint.
	 *
	 * @param RouteParamBag<string, mixed> $params Params for endpoint.
	 *
	 * @return mixed Response data.
	 * @throws \Exception .
	 */
	public function get_endpoint_response( RouteParamBag $params );
}
