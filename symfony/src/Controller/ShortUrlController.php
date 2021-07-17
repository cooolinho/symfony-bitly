<?php

namespace App\Controller;

use App\Entity\Link;
use App\Helper\LinkAccessLogHelper;
use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShortUrlController extends AbstractController
{
    /**
     * @Route("/x/{shortUrl}", name="short_url_index")
     */
    public function index(Request $request, LinkRepository $linkRepository): Response
    {
        $link = $linkRepository->findOneBy([
            'shortUrl' => $request->get('shortUrl'),
        ]);

        if ($link instanceof Link) {
            $this->updateLink($link, $request);

            return $this->redirect($link->getUrl());
        }

        $this->createNotFoundException();

        return $this->render('@frontend/short_url/index.html.twig', [
            'controller_name' => 'RedirectController',
        ]);
    }

    private function updateLink(Link $link, Request $request): void
    {
        $link->increaseCounter();
        $linkAccessLog = LinkAccessLogHelper::create($link, $request);

        $em = $this->container->get('doctrine')->getManager();
        $em->persist($link);
        $em->persist($linkAccessLog);

        $em->flush();
    }
}
