<?php
//titrage
namespace App\Controller;
//import-exports
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
// route par annotations
#[Route('/admin/product')]
class ProductController extends AbstractController
{//read all seulement pour les admin
    #[Route('/', name: 'app_product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }
//create 
   #[Route('/admin/new', name: 'app_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile){
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move(
                 $this->getParameter('images_directory'),
                 $newFilename
                );
                $product->setPath($newFilename);
            }

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

//read one 
    #[Route('/admin/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
//update
    #[Route('/admin/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }
//delete
    #[Route('/admin/{id}', name: 'app_product_delete', methods: ['POST'])]
    public function deleteProduct($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        // récupère le produit de la BdD avec son ID
        $product = $entityManager->getRepository(Product::class)->find($id);
    
        // vérifie si le produit existe
        if ($product) {
            $entityManager->remove($product);
            $entityManager->flush();
        }
    
        //redirige vers l'index
        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    }
}    