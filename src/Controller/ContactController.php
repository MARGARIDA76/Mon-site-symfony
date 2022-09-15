<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/contact')]
class ContactController extends AbstractController
{

    
    #[Route('/', name: 'contact.list')]
    public function index(ManagerRegistry $doctrine, ContactRepository $repository, PaginatorInterface $paginator, Request $request): Response 
    
    {
        $contacts = $paginator->paginate(
        $contacts = $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $repository = $doctrine->getRepository(persistentObject: Contact::class);
        return $this->render('contact/index.html.twig', ['contacts' => $contacts,]);
    }


    
    #[Route('/{id<\d+>}', name: 'contact.detail')]
    public function detail(Contact $contact = null): Response 
    
    {

        if(!$contact) {
            $this->addFlash(type: 'error', message: "Le contact n'existe pas");
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/detail.html.twig', ['contact' => $contact]);
    }

    #[Route('/detail', name: 'app_contact_detail', methods: ['GET'])]
    public function details(ContactRepository $contactRepository, $id ): Response
    {


        return $this->render('mission/detail.html.twig', [
            'contacts' => $contactRepository->findby($id),
        ]);
    }
   
   // #[Route('/', name: 'app_contact_index', methods: ['GET'])]
   // public function index(ContactRepository $contactRepository): Response
    //{
        //return $this->render('contact/index.html.twig', [
          //  'contacts' => $contactRepository->findAll(),
       // ]);
    //}

   // #[Route('/new', name: 'app_contact_new', methods: ['GET', 'POST'])]
   // public function new(Request $request, ContactRepository $contactRepository): Response
   // {
      //  $contact = new Contact();
       // $form = $this->createForm(ContactType::class, $contact);
        //$form->handleRequest($request);

       // if ($form->isSubmitted() && $form->isValid()) {
          //  $contactRepository->add($contact, true);

          //  return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
       // }

       // return $this->renderForm('contact/new.html.twig', [
           // 'contact' => $contact,
           //'form' => $form,
      //  ]);
   // }

    //#[Route('/{id}', name: 'app_contact_show', methods: ['GET'])]
   // public function show(Contact $contact): Response
    //{
       // return $this->render('contact/show.html.twig', [
           // 'contact' => $contact,
       //]);
   // }

   // #[Route('/{id}/edit', name: 'app_contact_edit', methods: ['GET', 'POST'])]
   // public function edit(Request $request, Contact $contact, ContactRepository $contactRepository): Response
   // {
      //  $form = $this->createForm(ContactType::class, $contact);
      //  $form->handleRequest($request);

       // if ($form->isSubmitted() && $form->isValid()) {
          //  $contactRepository->add($contact, true);

           // return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
      //  }

       // return $this->renderForm('contact/edit.html.twig', [
         //  'contact' => $contact,
           // 'form' => $form,
      //  ]);
 //   }

   // #[Route('/{id}', name: 'app_contact_delete', methods: ['POST'])]
   // public function delete(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    //{
      //  if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
         //   $contactRepository->remove($contact, true);
       // }

       // return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
   // }
}
