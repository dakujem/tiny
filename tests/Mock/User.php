<?php


namespace Dakujem\Tiny\Test\Mock;

use Tiny\CollectionReference,
	Tiny\CollectionReferenceInterface,
	Tiny\Reference,
	Tiny\ReferenceInterface;


/**
 * User
 *
 *
 * @author Andrej Rypák (dakujem) <xrypak@gmail.com>
 */
class User
{
	/**
	 * @var CollectionReferenceInterface
	 */
	private $orders;

	/**
	 * @var ReferenceInterface
	 */
	private $address;

	/**
	 * @var string
	 */
	private $name = NULL;


	public function __construct($attrs = [])
	{
		$this->orders = new CollectionReference(NULL, 'order');
		$this->address = new Reference(NULL, 'address');
		$this->hydrate($attrs);
	}


	public function hydrate($attrs = [])
	{
		foreach ($attrs as $name => $val) {
			if (property_exists($this, $name)) {
				if ($this->$name instanceof ReferenceInterface) {
					$ref = $this->$name;
					if ($ref instanceof \Tiny\MutableReferenceInterface) {
						if ($ref->accepts($val)) {
							$ref->referTo($val);
						} else {
							// ??
						}
					} else {
						// ??
					}
				} else {
					call_user_func([$this, 'set' . ucfirst($name)], $val);
				}
			}
		}
	}


	public function getOrders(): CollectionReferenceInterface
	{
		return $this->orders;
	}


	public function getAddress(): ReferenceInterface
	{
		return $this->address;
	}


	public function getName()
	{
		return $this->name;
	}


	public function setOrders(CollectionReferenceInterface $orders)
	{
		$this->orders = $orders;
		return $this;
	}


	public function setAddress(ReferenceInterface $address)
	{
		$this->address = $address;
		return $this;
	}


	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

}
