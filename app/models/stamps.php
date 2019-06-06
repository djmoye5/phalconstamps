<?php

use Phalcon\Mvc\Model;

class Stamps extends Model
{
	public $id;
	public $yearissued;
	public $collection;
	public $size;
	public $quantity;
	public $picture;
	public $description;
	public $glued;
	public $inserted;
}