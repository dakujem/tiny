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

	private $id = NULL;
	private $type = NULL;
	private $data = NULL;
	private $getter = NULL;
	private $loaded = FALSE;


	public function __construct($id, $type, $getter)
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


	private function load()
	{
		$this->loaded = TRUE;
		return $this->data = call_user_func($this->getter, $this);
	}

}
