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
    public function new(Request $request): Response
    {
        $<?= $entity_var_singular ?> = new <?= $entity_class_name ?>();
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($<?= $entity_var_singular ?>);
            $entityManager->flush();

            return $this->redirectToRoute('app_<?= $route_name ?>_index');
        }

        return $this->render('<?= $templates_path ?>/new.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{<?= $entity_identifier ?>}", name="app_<?= $route_name ?>_show", methods={"GET"})
     */
    public function show(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        return $this->render('<?= $templates_path ?>/show.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
        ]);
    }

    /**
     * @Route("/{<?= $entity_identifier ?>}/edit", name="app_<?= $route_name ?>_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_<?= $route_name ?>_index', [
                '<?= $entity_identifier ?>' => $<?= $entity_var_singular ?>->get<?= ucfirst($entity_identifier) ?>(),
            ]);
        }

        return $this->render('<?= $templates_path ?>/edit.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{<?= $entity_identifier ?>}", name="app_<?= $route_name ?>_delete", methods={"DELETE"})
     */
    public function delete(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        if ($this->isCsrfTokenValid('delete'.$<?= $entity_var_singular ?>->get<?= ucfirst($entity_identifier) ?>(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($<?= $entity_var_singular ?>);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_<?= $route_name ?>_index');
    }
}
