<?php

namespace Ecommerce\CatalogBundle\Controller;

use Ecommerce\CatalogBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 * @Route("product")
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('EcommerceCatalogBundle:Product')->findAll();

        return $this->render('@EcommerceCatalog/Default/product/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('Ecommerce\CatalogBundle\Form\ProductType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle image upload
            if($image = $product->getImage()){
                $name = $this->get('ecommerce_catalog.image_uloader')->upload($image);
                // Save image in DB
                $product->setImage($name);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product_index');
        }

        return $this->render('@EcommerceCatalog/Default/product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method("GET")
     */
    public function showAction(Product $product)
    {
//        $deleteForm = $this->createDeleteForm($product);

        return $this->render('@EcommerceCatalog/Default/product/show.html.twig', array(
            'product' => $product,
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product $product)
    {
        $oldImage = $product->getImage();
        if($oldImage){
            $product->setImage(new File($this->getParameter('ecommerce_images_directory'). '/'. $oldImage));
        }
//        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('Ecommerce\CatalogBundle\Form\ProductType', $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($image = $product->getImage()){
                $name = $this->get('ecommerce_catalog.image_uloader')->upload($image);
                $product->setImage($name);
            } elseif ($oldImage){
                $product->setImage($oldImage);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('@EcommerceCatalog/Default/product/edit.html.twig', array(
            'product' => $product,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}/delete", name="product_delete")
     */
    public function deleteAction(Request $request, Product $product)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();

        return $this->redirectToRoute('product_index');
    }
}
