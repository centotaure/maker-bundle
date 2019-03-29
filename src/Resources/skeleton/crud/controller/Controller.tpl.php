<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use <?= $entity_full_class_name ?>;
use <?= $form_full_class_name ?>;
<?php if (isset($repository_full_class_name)): ?>
use <?= $repository_full_class_name ?>;
<?php endif ?>
use Symfony\Bundle\FrameworkBundle\Controller\<?= $parent_class_name ?>;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\ApyDataGridController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Translation\TranslatorInterface;


/**
 * @Route("<?= $route_path ?>")
 * @IsGranted("ROLE_USER")
 */
class <?= $class_name ?> extends ApyDataGridController
{
    /**
     * @Route("/", name="app_<?= $route_name ?>_index", methods={"GET"})
     */
    public function indexAction(
    EntityManagerInterface $em,
    AuthorizationCheckerInterface $checker,
    TokenStorageInterface $token
    ) {

        $data = array(
        'entity' => 'App:<?= $entity_class_name ?>',
        'show' => 'app_<?= $route_name ?>_show',
        'edit' => 'app_<?= $route_name ?>_edit',
        'delete' => 'app_<?= $route_name ?>_delete',
        );

        $this->gridList($data);

        $em->getRepository(<?= $entity_class_name ?>::class)->getList(
        $this->grid->getSource(),
        $checker,
        $token->getToken()->getUser()
        );



        return $this->grid->getGridResponse(
        '<?= $templates_path ?>/index.html.twig'
        );
    }




    /**
     * @Route("/new", name="app_<?= $route_name ?>_new", methods={"GET","POST"})
     */
    public function newAction(Request $request ,TranslatorInterface $translator): Response
    {
        $<?= $entity_var_singular ?> = new <?= $entity_class_name ?>();
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $<?= $entity_var_singular ?>->setUpdatedAt(new \Datetime('now'));
            $<?= $entity_var_singular ?>->setCreatedAt(new \Datetime('now'));
            $entityManager->persist($<?= $entity_var_singular ?>);
            $entityManager->flush();
            $this->addSuccess($translator->trans('entity.<?= strtolower($entity_class_name) ?>.createok'));

            return $this->redirectToRoute('app_<?= $route_name ?>_show');
        }

        return $this->render('<?= $templates_path ?>/new.html.twig', [
            '<?= $entity_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{<?= $entity_identifier ?>}", name="app_<?= $route_name ?>_show", methods={"GET"})
     */
    public function showAction(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        return $this->render('<?= $templates_path ?>/show.html.twig', [
            '<?= $entity_var_singular ?>' => $<?= $entity_var_singular ?>
        ]);
    }

    /**
     * @Route("/{<?= $entity_identifier ?>}/edit/{route}", name="app_<?= $route_name ?>_edit", methods={"GET","POST"},defaults={"route":null})
     */
    public function editAction(Request $request,TranslatorInterface $translator, <?= $entity_class_name ?> $<?= $entity_var_singular ?>, $route="index"): Response
    {
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $<?= $entity_var_singular ?>->setUpdatedAt(new \Datetime('now'));
            $this->getDoctrine()->getManager()->flush();
            $this->addSuccess($translator->trans('entity.<?= strtolower($entity_class_name) ?>.editok'));
            return $this->redirectToRoute('app_<?= $route_name ?>_'.$route, [
                '<?= $entity_identifier ?>' => $<?= $entity_var_singular ?>->get<?= ucfirst($entity_identifier) ?>(),
                'route' => $route
            ]);
        }

        return $this->render('<?= $templates_path ?>/edit.html.twig', [
            '<?= $entity_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form->createView(),
            'route' => $route
        ]);
    }

    /**
    * @Route("/delete/{<?= $entity_identifier ?>}/{route}", name="app_<?= $route_name ?>_delete",defaults={"route":null} )
    * @Method("DELETE")
    */
    public function deleteAction(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>, $route="index")
    {
        $form = $this->createDeleteForm($<?= $entity_var_singular ?>);
        $form->handleRequest($request);

        if ($request->isMethod('Get')) {
            return $this->render('<?= $entity_class_name ?>/confirm_delete.html.twig', [
                '<?= $entity_var_singular ?>' => $<?= $entity_var_singular ?>,
                'route' => $route,
                'deleteForm' => $form->createView(),
            ]);
        } else {
            if ($form->isSubmitted() && $form->isValid()) {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->remove($<?= $entity_var_singular ?>);
                    $entityManager->flush();
                    $this->deletedSuccess();
             }
            return $this->redirectToRoute('app_<?= $route_name ?>_index');
        }

    }

    private function createDeleteForm(<?= $entity_class_name ?> $<?= $entity_var_singular ?>)
    {
        return $this->createFormBuilder()
        ->setAction($this->generateUrl('app_<?= $route_name ?>_delete', array('<?= $entity_identifier ?>' => $<?= $entity_var_singular ?>->get<?= ucfirst($entity_identifier) ?>())))
        ->setMethod('DELETE')
        ->add(
        'submit',
        \Symfony\Component\Form\Extension\Core\Type\SubmitType::class,
        array(
        'attr' => array('class' => 'alert button'),
        'label' => 'form.delete',
        )
        )
        ->getForm();
    }
}
