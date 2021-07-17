<?php

namespace App\Controller\Admin;

use App\Entity\Link;
use App\Entity\Team;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;

class LinkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Link::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextareaField::new('url')->hideOnIndex(),
            TextField::new('shortUrl')->hideOnForm(),
            TextField::new('description'),
            TextField::new('absoluteUrl')->onlyOnDetail(),
            IntegerField::new('counter')->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function detail(AdminContext $context): Response
    {
        /** @var Router $router */
        $router = $this->container->get('router');

        /** @var Link $link */
        $link = $context->getEntity()->getInstance();

        $absoluteUrl = $router->generate('short_url_index', ['shortUrl' => $link->getShortUrl()], Router::ABSOLUTE_URL);
        $link->setAbsoluteUrl($absoluteUrl);

        return $this->render(
            '@EasyAdmin/crud/detail.html.twig',
            array_merge(parent::detail($context)->all(), [
                'link' => $link,
            ])
        );
    }
}
