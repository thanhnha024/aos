<?php

namespace WPDesk\FCF\Free\Collections;

use Doctrine\Common\Collections\ArrayCollection;
use WPDesk\FCF\Free\Exception\UnexpectedParamException;

/**
 * Route Parameters as collection.
 *
 * @template TKey of string
 * @template T
 * @extends ArrayCollection<TKey, T>
 */
class RouteParamBag extends ArrayCollection {

	/**
	 * Returns the nested array as collection.
	 *
	 * @param string $key
	 * @throws UnexpectedParamException
	 *
	 * @return RouteParamBag<TKey, T>
	 */
	public function collection( string $key ): RouteParamBag {
		if ( ! is_array( $this->get( $key ) ) ) {
			throw new UnexpectedParamException(
				sprintf(
					'Parameter "%s" is not an array.',
					$key
				)
			);
		}

		return new static( $this->get( $key ) );
	}

	/**
	 * Returns the parameter as string.
	 *
	 * @param string $key
	 * @throws UnexpectedParamException
	 *
	 * @return string
	 */
	public function getString( string $key ): string {
		$value = $this->get( $key );
		if ( ! \is_scalar( $value ) && ! $value instanceof \Stringable ) {
			throw new UnexpectedParamException(
				sprintf(
					'Parameter value "%s" cannot be converted to "string".',
					$key
				)
			);
		}

		return (string) $value;
	}

	/**
	 * Reduce the array to a single value using a callback function.
	 *
	 * @param \Closure $callback The callback function to apply
	 * @param mixed $initial The initial value
	 * @return mixed The single value resulting from the reduction
	 */
	public function reduce( \Closure $callback, $initial = null ) {
		return array_reduce( $this->toArray(), $callback, $initial );
	}
}
