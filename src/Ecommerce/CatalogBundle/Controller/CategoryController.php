<?php

namespace Ecommerce\CatalogBundle\Controller;

use Ecommerce\CatalogBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Category controller.
 */
class CategoryController extends Controller
{
    /**
     * Lists all category entities.
     *
     * @Route("admin/category/", name="category_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('EcommerceCatalogBundle:Category')->findAll();

        return $this->render('@EcommerceCatalog/Default/category/index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new category entity.
     *
     * @Route("admin/category/new", name="category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('Ecommerce\CatalogBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Image upload : use ImageUploader service
            /**
             * @var $image UploadedFile
             */
            if($image = $category->getImage()){
                // upload the image
                $name = $this->get('ecommerce_catalog.image_uloader')->upload($image);

                // Save the image in DB
                $category->setImage($name);
            }
            $em = $this->getDoctrine()->getManager();
            // If the url key is empty : create is from the title
           if($category->getUrlKey() === null){
               $category->setUrlKey($em->getRepository(Category::class)->createUrlKey($category->getTitle()));
           }
           // If the user entered url key
            $category->setUrlKey($em->getRepository(Category::class)->createUrlKey($category->getUrlKey()));
           // Create record
           $em->persist($category);
            $em->flush();
            // Redirect to the list page
            return $this->redirectToRoute('category_index', array('id' => $category->getId()));
        }

        return $this->render('@EcommerceCatalog/Default/category/new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a category entity.
     *
     * @Route("category/{id}", name="category_show")
     * @Method("GET")
     */
    public function showAction(Category $category)
    {
        return $this->render('@EcommerceCatalog/Default/category/show.html.twig', array(
            'category' => $category,
        ));
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     * @Route("admin/category/{id}/edit", name="category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category)
    {
        // Get entity manager
        $em = $this->getDoctrine()->getManager();
        // Old image
        $oldImage = $category->getImage();
        if($oldImage){
            $category->setImage(new File($this->getParameter('ecommerce_images_directory') .'/'. $oldImage));
        }
//        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('Ecommerce\CatalogBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($image = $category->getImage()){
                $name = $this->get('ecommerce_catalog.image_uloader')->upload($image);
                $category->setImage($name);
            } elseif ($oldImage){
                $category->setImage($oldImage);
            }
            // If the user changed the url key
            if(isset($_POST['ecommerce_catalogbundle_category']['urlKey'])){
                $category->setUrlKey($em->getRepository(Category::class)->createUrlKey($category->getUrlKey()));
            }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('category_index');
        }

        return $this->render('@EcommerceCatalog/Default/category/edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a category entity.
     *
     * @Route("admin/category/{id}/delete", name="category_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Category $category)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        return $this->redirectToRoute('category_index');
    }
    /*
    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    */
}
