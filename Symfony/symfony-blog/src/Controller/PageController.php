<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Post;
use App\Form\ContactFormType;
use Doctrine\Persistence\ManagerRegistry;
use Proxies\__CG__\App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
{
    $repository = $doctrine->getRepository(Category::class);

    $categories = $repository->findAll();

    return $this->render('page/index.html.twig', ['categories' => $categories]);
}

    #[Route('/aboutUs', name: 'about_us')]
    public function about_us(): Response
    {
        return $this->render('page/aboutUs.html.twig', []);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(ManagerRegistry $doctrine, Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contacto = $form->getData();    
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($contacto);
            $entityManager->flush();
            return $this->redirectToRoute('thankyou', []);
        }
        return $this->render('page/contact.html.twig', array(
            'form' => $form->createView()    
        ));
    }


}
