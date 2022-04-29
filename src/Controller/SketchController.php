<?php

namespace App\Controller;

use App\Entity\Sketch;
use App\Form\SketchType;
use App\Repository\SketchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sketch')]
class SketchController extends AbstractController
{
    #[Route('/', name: 'app_sketch_index', methods: ['GET'])]
    public function index(SketchRepository $sketchRepository): Response
    {
        return $this->render('sketch/index.html.twig', [
            'sketches' => $sketchRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sketch_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SketchRepository $sketchRepository): Response
    {
        $sketch = new Sketch();
        $form = $this->createForm(SketchType::class, $sketch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sketchRepository->add($sketch);
            return $this->redirectToRoute('app_sketch_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sketch/new.html.twig', [
            'sketch' => $sketch,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sketch_show', methods: ['GET'])]
    public function show(Sketch $sketch): Response
    {
        return $this->render('sketch/show.html.twig', [
            'sketch' => $sketch,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sketch_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sketch $sketch, SketchRepository $sketchRepository): Response
    {
        $form = $this->createForm(SketchType::class, $sketch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sketchRepository->add($sketch);
            return $this->redirectToRoute('app_sketch_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sketch/edit.html.twig', [
            'sketch' => $sketch,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sketch_delete', methods: ['POST'])]
    public function delete(Request $request, Sketch $sketch, SketchRepository $sketchRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sketch->getId(), $request->request->get('_token'))) {
            $sketchRepository->remove($sketch);
        }

        return $this->redirectToRoute('app_sketch_index', [], Response::HTTP_SEE_OTHER);
    }
}
