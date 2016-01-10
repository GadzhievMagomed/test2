<?php namespace Models;
/**
 * @Entity @Table(name="reviews")
 **/
class Review
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="datetime") **/
    protected $publish_date;
    /** @Column(type="string") **/
    protected $name;
    /** @Column(type="string") **/
    protected $ip;
    /** @Column(type="text") **/
    protected $text;
    /** @Column(type="integer") **/
    protected $likes = null;


    public function __construct()
    {


    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getPublishDate()
    {
        return $this->publish_date;

    }
}