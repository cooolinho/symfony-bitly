<?php

namespace App\Controller\Admin;

use App\Entity\Link;
use Cooolinho\Bundle\SecurityBundle\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public const ROUTE_INDEX = 'admin_dashboard_index';

    /**
     * @Route("/admin", name="admin_dashboard_index")
     */
    public function index(): Response
    {
        return $this->render('@admin/dashboard/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bitly Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Links', 'fas fa-list', Link::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
    }
}
