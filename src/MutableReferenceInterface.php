<?php


namespace Tiny;


/**
 * MutableReferenceInterface
 *
 *
 * @author Andrej Rypák (dakujem) <xrypak@gmail.com>
 */
interface MutableReferenceInterface extends ReferenceInterface
{


	function accepts($data): bool;


	function referTo($entityOrId);


	function setId($id);

}
