<?php

namespace App\Controller;

use App\Entity\Link;
use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShortUrlController extends AbstractController
{
    /**
     * @Route("/x/{shortUrl}", name="redirect")
     */
    public function index(Request $request, LinkRepository $linkRepository): Response
    {
        $link = $linkRepository->findOneBy([
            'shortUrl' => $request->get('shortUrl'),
        ]);

        if ($link instanceof Link) {
            $this->updateLink($link);

            return $this->redirect($link->getUrl());
        }

        $this->createNotFoundException();

        return $this->render('redirect/index.html.twig', [
            'controller_name' => 'RedirectController',
        ]);
    }

    private function updateLink(Link $link): void
    {
        $link->increaseCounter();

        $em = $this->container->get('doctrine')->getManager();
        $em->persist($link);
        $em->flush();
    }
}
