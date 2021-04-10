<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

/**
 * Class AuthorService
 * @package App\Services
 */
class AuthorService
{
    use ConsumesExternalService;

    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public $baseUri;

    /**
     * AuthorService constructor.
     */
    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
    }

    /**
     * @return string
     */
    public function obtainAuthors(){
        return $this->performRequest('GET', 'authors');
    }

    /**
     * @param $data
     * @return string
     */
    public function createAuthor($data){
        return $this->performRequest('POST', 'authors', $data);
    }

    /**
     * @param $author
     * @return string
     */
    public function obtainAuthor($author){
        return $this->performRequest('GET', "authors/{$author}");
    }

    /**
     * @param $data
     * @param $author
     * @return string
     */
    public function editAuthor($data, $author){
        return $this->performRequest('PATCH', "authors/{$author}", $data);
    }

    /**
     * @param $author
     * @return string
     */
    public function deleteAuthor($author){
        return $this->performRequest('DELETE', "authors/{$author}");
    }
}
