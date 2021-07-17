<?php

namespace App\Helper;

use App\Entity\Link;
use App\Entity\LinkAccessLog;
use Symfony\Component\HttpFoundation\Request;

class LinkAccessLogHelper
{
    public static function create(Link $link, Request $request): LinkAccessLog
    {
        $linkAccessLog = new LinkAccessLog($link);
        $linkAccessLog->setHttpUserAgent($request->headers->get('user-agent'));
        $linkAccessLog->setClientIp($request->getClientIp());

        return $linkAccessLog;
    }
}
