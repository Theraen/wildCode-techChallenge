<?php

namespace App\Controller;

use App\Entity\Argonaute;
use App\Form\ArgonauteType;
use App\Repository\ArgonauteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $em;
    private $argonauteRepository;

    public function __construct(EntityManagerInterface $em, ArgonauteRepository $argonauteRepository)
    {
        $this->em = $em;
        $this->argonauteRepository = $argonauteRepository;
    }
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request): Response
    {

        $argonaute = new Argonaute();

        $form = $this->createForm(ArgonauteType::class, $argonaute);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($argonaute);
            $this->em->flush();

            return $this->redirectToRoute('home');
        }

        $argonautes = $this->argonauteRepository->findAll();

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'argonautes' => $argonautes
        ]);
    }
}
