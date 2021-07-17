<?php

namespace App\EventSubscriber;

use App\Entity\Link;
use App\Helper\ShortUrlHelper;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LinkSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => 'onBeforeEntityPersistedEvent',
            BeforeEntityUpdatedEvent::class => 'onBeforeEntityUpdatedEvent',
        ];
    }

    public function onBeforeEntityPersistedEvent(BeforeEntityPersistedEvent $event): void
    {
        $link = $event->getEntityInstance();

        if (!$link instanceof Link || $link->getShortUrl() !== null) {
            return;
        }

        $link->setShortUrl(ShortUrlHelper::generate());
    }

    public function onBeforeEntityUpdatedEvent(BeforeEntityUpdatedEvent $event): void
    {
        $link = $event->getEntityInstance();

        if (!$link instanceof Link) {
            return;
        }

        $link->setUpdatedAt(new \DateTime());
    }
}
