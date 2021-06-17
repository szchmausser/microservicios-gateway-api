<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

/**
 * Class BookService
 * @package App\Services
 */
class BookService
{
    use ConsumesExternalService;

    public $baseUri;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    /**
     * @return string
     */
    public function obtainBooks(){
        return $this->performRequest('GET', 'books');
    }

    /**
     * @param $data
     * @return string
     */
    public function createBook($data){
        return $this->performRequest('POST', 'books', $data);
    }

    /**
     * @param $book
     * @return string
     */
    public function obtainBook($book){
        return $this->performRequest('GET', "books/{$book}");
    }

    /**
     * @param $data
     * @param $book
     * @return string
     */
    public function editBook($data, $book){
        return $this->performRequest('PATCH', "books/{$book}", $data);
    }

    /**
     * @param $book
     * @return string
     */
    public function deleteBook($book){
        return $this->performRequest('DELETE', "books/{$book}");
    }
}
