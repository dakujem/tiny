<?php


namespace Tiny;

use ArrayIterator;


/**
 * CollectionReference
 *
 *
 * @author Andrej Rypák (dakujem) <xrypak@gmail.com>
 */
class CollectionReference implements CollectionReferenceInterface
{

	private $id = NULL;
	private $type = NULL;

	/**
	 * @var ReferenceInterface[]
	 */
	private $data = [];
	private $getter = NULL;
	private $loaded = FALSE;


	public function __construct($id, $type, $getter = NULL)
	{
		$this->id = $id;
		$this->type = $type;
		$this->getter = $getter;
	}


	public function id()
	{
		return $this->id;
	}


	public function type()
	{
		return $this->type;
	}


	public function deref()
	{
		return $this->loaded() ? $this->data : $this->load();
	}


	public function loaded(): bool
	{
		return $this->loaded;
	}


	public function getIterator()
	{
		return new ArrayIterator($this->data);
	}


	private function load()
	{
		$this->loaded = TRUE;
		if ($this->getter === NULL) {
			// no getter set, fall back to using getters of the individual references in the collection
			$result = [];
			foreach ($this->data as $key => $reference) {
				$result[$key] = $reference->deref();
			}
			return $this->data = $result;
		}
		return $this->data = call_user_func($this->getter, $this);
	}

}
