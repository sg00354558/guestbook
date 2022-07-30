<?php

namespace App\Controller;

use App\Repository\GuestbookRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    private $guestbookRepository;
    private $paginator;

    public function __construct(GuestbookRepository $guestbookRepository, PaginatorInterface $paginator){
        $this->guestbookRepository = $guestbookRepository;
        $this->paginator = $paginator;
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(Request $request): Response
    {
        $guestbookData = $this->guestbookRepository->findAll();

        $pagination = $this->paginator->paginate(
            $guestbookData, /* query NOT result */
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
        );

        return $this->render('admin/index.html.twig', [
            'guestbookData' => $guestbookData,
            'pagination' => $pagination
        ]);
    }
}
