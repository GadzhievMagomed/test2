<?php namespace Models;
/**
 * @Entity @Table(name="reviews_likes")
 **/
class Review_like
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="integer") **/
    protected $review_id;
    /** @Column(type="datetime") **/
    protected $date;
    /** @Column(type="string") **/
    protected $ip;

    public function __construct()
    {


    }


    public function getIp()
    {
        return $this->getIp;
    }

    // .. (other code)
}