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

//
// Note: it should be implementation detail to mark a reference "loaded" and so optimize the deref() call
//
//	/**
//	 * Has the reference been loaded, has it been dereferenced?
//	 */
//	function loaded(): bool;

}
