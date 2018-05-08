<?php


namespace Tiny;


/**
 * Reference
 *
 *
 * @author Andrej Rypák (dakujem) <xrypak@gmail.com>
 */
class Reference implements ReferenceInterface
{
	private $id = null;
	private $type = null;
	private $data = null;
	private $getter = null;
	private $loaded = false;


	/**
	 * Usage:
	 *
	 * new Reference({id}, {type}, {getter});
	 * new Reference({entity});
	 *
	 * @param int|string|EntityInterface $id
	 * @param string $type
	 * @param callable $getter
	 */
	public function __construct($id, $type = NULL, $getter = NULL)
	{
		if ($id instanceof EntityInterface) {
			$this->id = $id->getId();
			$this->type = $id->getType();
			$this->data = $id;
			$this->loaded = true;
		} else {
			$this->id = $id;
			$this->type = $type;
			$this->getter = $getter;
		}
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


	private function load()
	{
		$this->loaded = true;
		return $this->data = call_user_func($this->getter, $this);
	}

}
