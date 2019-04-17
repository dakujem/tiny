
# Tiny

A loose and tiny toolkit for modeling application entities.

> :bulb:
>
> Note: This is currenty just a draft of such a toolkit / thoughts on the topic

The idea is to conform to Uncle Bob's **Clean Architecture** without sacrificing the ease of use of an ORM.

Simply put, to fetch a related entity,
the current entity must not be required to know anything about *how* the related entity should be fetched.
In fact, it should not even care.

As a result, the underlying implementation of storage or data retrieval can change
without the need to modify anything in the application's internal (business) logic
and the entities can be used across multiplne application layers without breaking the *dependency rule*.


## Implementation


### Reference

- `deref()` should be implemented using a customisable callback


### CollectionReference

- `deref()` should also be implemeted using a custom callback optimized for retreiving collections,
	however it should fall back to calling `deref()` on each contained `Reference` when no callback is provided
- homogenous / heterogenous (flag, validation or both?)



### Entity

- property collection?
	- each entity own property set for dynamic modification
	- or one property set for one entity type ?
- property provider?

What I want to be able to do:

```php
$bar = $entity->foo;
$entity->foo = $bar;

$entity->collection[4] = 'someData';
$someData = $entity->collection[4];
$collection = $entity->collection;
$entity->collection = $collection;

$ref = $entity->relatedObject;
$relative = $entity->relatedObject->deref();
$entity->relatedObject = 4; // treat as ID
$entity->relatedObject = $relative;
$entity->relatedObject = $ref;

$relatives = $entity->relatedCollection->deref();
$relative = $entity->relatedCollection[4]->deref(); // shorthand for the below
$relative = $entity->relatedCollection->deref()[4]->deref();  // this would be equivalent to the above ^
$entity->relatedCollection[4] = $relative; // how about this one then?
$collection = $entity->collection;
$entity->relatedCollection = $relatives;
$entity->relatedCollection[] = $relative;
$entity->relatedCollection = $entity->relatedCollection;

$clone = $entity->clone()->resetId();

$entity->getChanges();
$entity->isChanged();

// how about filtering?
$relatives = $entity->relatedCollection->deref(new FilterObject);

// how about intermediate caching?
$entity->relatedCollection->deref();
```

### EntityCollection

Homogeneous.


### EntityHeap

A heap. A Pile. A stack. Heterogeneous.


## Other thoughts

- ability to automatically dereference (should be optional) on method call or member access, so no need to call `$post->author->deref()->getAge()`, instead `$post->author->getAge()` should be possible if desired

To consider:
- changes-tracking and other "reactions to change" implemented via observer pattern
	- attachable observers (objects/callables)
	- it would mean forcing all entity attribute access via setter/getter methods (or magic getters/setters)
	- everything else that is not data should be placed in internal `_meta` attribute
- `ReferenceInterface` to extend `EntityInterface` ??
- reference getter validators (string classname or function, can be string "is_scalar")
	- must return true/false
	- to ensure the dereferencer getter returns valid/expected type
- N+1 problem
	- eager loading vs. lazy loading
