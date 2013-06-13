<?php

use LeanMapper\Entity;
use LeanMapper\Result;
use LeanMapper\Row;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

//////////

/**
 * @property int $id
 * @property string $name
 * @property string $pubdate
 */
class Book extends Entity
{
}

//////////

$book = new Book;

Assert::type('Book', $book);

//////////

$data = array(
	'id' => 1,
	'name' => 'PHP guide',
	'pubdate' => '2013-06-13',
);

$book = new Book($data);

Assert::type('Book', $book);
Assert::equal($data, $book->getData());

//////////

$dibiRow = new DibiRow($data);
$row = new Row(Result::getInstance($dibiRow, 'book', $connection), 1);
$book = new Book($row);

Assert::type('Book', $book);
Assert::equal($data, $book->getData());

//////////

$dibiRow = new DibiRow($data);
$row = Result::getInstance($dibiRow, 'book', $connection)->getRow(1);
$book = new Book($row);

Assert::type('Book', $book);
Assert::equal($data, $book->getData());

//////////

Assert::exception(function () {
	new Book(false);
}, 'LeanMapper\Exception\InvalidArgumentException', '$arg in entity constructor must be either null, array or instance of LeanMapper\Row, boolean given.');

Assert::exception(function () {
	new Book('hello');
}, 'LeanMapper\Exception\InvalidArgumentException', '$arg in entity constructor must be either null, array or instance of LeanMapper\Row, string given.');