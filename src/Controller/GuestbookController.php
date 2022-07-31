<?php

namespace App\Controller;

use App\Entity\Guestbook;
use App\Form\GuestbookFormType;
use App\Repository\GuestbookRepository;
use App\Service\GuestbookService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GuestbookController extends AbstractController
{
    private $em;
    private $guestbookRepository;
    private $paginator;
    private $guestbookService;

    public function __construct(GuestbookRepository $guestbookRepository, EntityManagerInterface $em, PaginatorInterface $paginator, 
    GuestbookService $guestbookService){
        $this->guestbookRepository = $guestbookRepository;
        $this->paginator = $paginator;
        $this->em = $em;
        $this->guestbookService = $guestbookService;
    }

    #[Route('/guestbook', name: 'app_guestbook')]
    public function index(Request $request) : Response
    {
        $guestbookData = $this->guestbookRepository->findBy(array('approvalStatus' => Guestbook::APPROVAL_STATUS),array('id' => 'Desc'));

        $guestbook = new Guestbook;
        $form = $this->createForm(GuestbookFormType::class, $guestbook);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $newGuestbookEntry = $form->getData();
            if($this->getUser()->isAdmin()){
                $newGuestbookEntry->setApprovalStatus(GuestBook::APPROVAL_STATUS);
            }

            $username = $this->getUser()->getUserIdentifier();
            $newGuestbookEntry->setUser($this->getUser());
            
            $this->em->persist($newGuestbookEntry);
            $this->em->flush();

            $this->addFlash('success', 'Entry Created Successfully');
            return $this->redirectToRoute('app_guestbook');
        }   

        $pagination = $this->paginator->paginate(
            $guestbookData, /* query NOT result */
                $request->query->getInt('page', 1), /*page number*/
                10 /*limit per page*/
        );

        return $this->render('guestbook/index.html.twig', [
            'guestbookData' => $guestbookData,
            'form' => $form->createView(),
            'pagination' => $pagination
        ]);
    }

    #[Route('/guestbook/create', methods:['get', 'post'], name: 'create_guestbook')]
    public function create(Request $request) : Response
    {
        $guestbook = new Guestbook;
        $form = $this->createForm(GuestbookFormType::class, $guestbook);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $newGuestbookEntry = $form->getData();
            if($this->getUser()->isAdmin()){
                $newGuestbookEntry->setApprovalStatus(GuestBook::APPROVAL_STATUS);
            }

            $username = $this->getUser()->getUserIdentifier();
            $newGuestbookEntry->setUser($this->getUser());
            
            $this->em->persist($newGuestbookEntry);
            $this->em->flush();

            $this->addFlash('success', 'Entry Created Successfully');
        }    

        return $this->render('guestbook/create.html.twig', [
            'guestbookData' => $guestbook,
            'form' => $form->createView()
        ]);
    }

    #[Route('/guestbook/delete/{id}', methods:['GET', 'DELETE'], name: 'remove_guestbook')]
    public function delete($id) : Response 
    {
        $geustBookEntry = $this->guestbookRepository->find($id);
        $this->guestbookRepository->remove($geustBookEntry);
        
        $this->addFlash('success', 'Entry deleted Successfully');

        return $this->redirectToRoute('app_admin');
    }

    #[Route('/guestbook/approve/{id}', methods:['GET', 'PUT'], name: 'approve_guestbook_entry')]
    public function approve(Guestbook $guestbook) : Response 
    {
        $this->guestbookService->updateGuestbookStatus($guestbook);
        $this->addFlash('success', 'Status updated successfully');
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/guestbook/edit/{id}', name: 'edit_guestbook')]
    public function edit($id, Request $request) : Response 
    {
        $guestbook = $this->guestbookRepository->find($id);
        $form = $this->createForm(GuestbookFormType::class, $guestbook);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            $guestbook->setComment($form->get('comment')->getData());
            // dd($newGuestbookEntry);
            $this->em->persist($guestbook);
            $this->em->flush();

            $this->addFlash('success', 'Entry updated Successfully');
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('guestbook/edit.html.twig', [
            'guestbookData' => $guestbook,
            'form' => $form->createView()
        ]);
    }
}
