<?php

namespace AppBundle\DataFixtures\ORM;

namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity;
use DateTime;

class Note implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach($this->getData() as $payload)
        {
            $post = new Entity\Post();
            $post->setTitle($payload[0]);
            $post->setContent($payload[1]);
            $post->setCreated($payload[2]);
            $manager->persist($post);
        }
        $manager->flush();
    }

    private function getData()
    {
        return [
            ['Oldest post', 'Oldest post content', new DateTime('2010-01-01 10:00:00')],
            ['Almost Oldest post', 'Almost Oldest post content', new DateTime('2011-01-01 10:00:00')],
            ['Middle post', 'Middle post content', new DateTime('2012-01-01 10:00:00')],
            ['Almost Newest post', 'Almost Newest post content', new DateTime('2014-01-01 10:00:00')],
            ['Newest post', 'Newest post content', new DateTime()],
        ];
    }
}
