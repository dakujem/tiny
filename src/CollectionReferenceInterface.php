<?php


namespace Tiny;


/**
 * CollectionReferenceInterface
 *
 *
 * @author Andrej Rypák (dakujem) <xrypak@gmail.com>
 */
interface CollectionReferenceInterface extends ReferenceInterface
{


	/**
	 * Return a collection of data by dereferencing the reference collection.
	 */
	function deref();


	/**
	 * Return an interator to iterate over the reference collection.
	 * 
	 * Note: this method does not return referenced data. Use deref method for that purpose.
	 */
	function getIterator();

}
