<?php

namespace App\EventSubscriber;

use App\Entity\Link;
use App\Helper\ShortUrlHelper;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LinkSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => 'onBeforeEntityPersistedEvent',
        ];
    }

    public function onBeforeEntityPersistedEvent(BeforeEntityPersistedEvent $event): void
    {
        $link = $event->getEntityInstance();

        if (!$link instanceof Link) {
            return;
        }

        $link->setShortUrl(ShortUrlHelper::generate());
    }
}
