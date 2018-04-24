<?php


namespace Tiny;


/**
 * ReferenceInterface
 *
 *
 * @author Andrej Rypák (dakujem) <xrypak@gmail.com>
 */
interface ReferenceInterface
{


	/**
	 * Get ID.
	 */
	function id();


	/**
	 * Get Type.
	 */
	function type();


	/**
	 * Dereference the reference, get the referenced data.
	 */
	function deref();


	/**
	 * Has the reference been loaded, has it been dereferenced?
	 */
	function loaded(): bool;

}
