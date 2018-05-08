<?php


namespace Dakujem\Tiny\Test\Mock;

use Exception,
	Tiny\CollectionReference,
	Tiny\CollectionReferenceInterface,
	Tiny\EntityInterface,
	Tiny\Hydratable,
	Tiny\MutableReferenceInterface,
	Tiny\Reference,
	Tiny\ReferenceInterface,
	Tiny\Squeezable;


/**
 * User
 *
 *
 * @author Andrej Rypák (dakujem) <xrypak@gmail.com>
 */
class User implements Hydratable, Squeezable, EntityInterface
{
	/**
	 * @var int
	 */
	private $id;

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
	private $name = null;


	public function __construct($attrs = [])
	{
		$this->orders = new CollectionReference(null, 'order');
		$this->address = new Reference(null, 'address');
		$this->hydrate($attrs);
	}


	public function id()
	{
		return $this->id;
	}


	public function type()
	{
		return 'user';
	}


	public function hydrate(iterable $attrs)
	{
		foreach ($attrs as $name => $val) {
			if (property_exists($this, $name)) {
				if ($this->$name instanceof ReferenceInterface) {
					$ref = $this->$name;
					if ($ref instanceof MutableReferenceInterface) {
						if ($ref->accepts($val)) {
							$ref->referTo($val);
						} else {
							// ?? throw exception
						}
					} elseif ($val instanceof EntityInterface && $val->type() === $ref->type()) {
						// pseudo-assign when types match
						$this->$name = new Reference($val->id(), $val->type(), function() use ($val) {
							return $val;
						});
					} else {
						// ?? pseudo-assign as above or throw exception ?
					}
				} else {
					call_user_func([$this, 'set' . ucfirst($name)], $val);
				}
			}
		}
	}


	public function squeeze(): iterable
	{
		throw new Exception('TODO');
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
