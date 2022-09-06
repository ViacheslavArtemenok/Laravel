<?php

declare(strict_types=1);

namespace App\Queries;

final class QueryBuilderFactory
{
    /**
     * Возвращает фабрику
     *
     * @return AbstractFactory 
     * @throws Exception
     */
    public static function getAuthor(): AuthorQueryBuilder
    {
        return new AuthorQueryBuilder();
    }
    public static function getUser(): UserQueryBuilder
    {
        return new UserQueryBuilder();
    }
    public static function getCategory(): CategoryQueryBuilder
    {
        return new CategoryQueryBuilder();
    }
    public static function getNews(): NewsQueryBuilder
    {
        return new NewsQueryBuilder();
    }
}
