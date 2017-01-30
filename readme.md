
# Tiny

A loose and tiny toolkit for modeling application entities.


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

$relative = $entity->relatedObject->deref();
$ref = $entity->relatedObject;
$entity->relatedObject = 4; // treat as ID
$entity->relatedObject = $relative;
$entity->relatedObject = $ref;

$relatives = $entity->relatedCollection->deref();
$relative = $entity->relatedCollection[4]->deref();
$entity->relatedCollection[4] = $relative;
$collection = $entity->collection;
$entity->relatedCollection = $relatives;
$entity->relatedCollection[] = $relative;
$entity->relatedCollection = $entity->relatedCollection;

$clone = $entity->clone()->resetId();

$entity->getChanges();
$entity->isChanged();

```