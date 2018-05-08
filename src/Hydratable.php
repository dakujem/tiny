<?php


namespace Tiny;


/**
 * Hydratable - interface for entities that can be "hydrated", i.e. populated with data from outside.
 *
 *
 * @author Andrej Rypák (dakujem) <xrypak@gmail.com>
 */
interface Hydratable
{


	/**
	 * Usage:
	 * $entity->hydrate([ 'foo' => "bar", 'property2' => 'value2' ]);
	 *
	 * @param iterable $attributes
	 */
	function hydrate(iterable $attributes);

}
