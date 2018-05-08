<?php


namespace Tiny;


/**
 * Squeezable - interface for entities that can provide internal data as an array, or in a format usable by Hydratable::hydrate.
 *
 * This can be used for serialization and/or storing purposes.
 *
 *
 * @author Andrej Rypák (dakujem) <xrypak@gmail.com>
 */
interface Squeezable
{


	function squeeze(): iterable;

}
