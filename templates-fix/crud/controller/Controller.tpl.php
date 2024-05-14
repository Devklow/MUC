<?= "<?php\n" ?>

namespace <?= $namespace ?>;

<?= $use_statements; ?>

<?php if ($use_attributes) { ?>
#[Route('<?= $route_path ?>')]
<?php } else { ?>
/**
 * @Route("<?= $route_path ?>", name="<?= substr($route_name,4) ?>_")
 */
<?php } ?>
class <?= $class_name ?> extends AbstractController
{
<?= $generator->generateRouteForControllerMethod('/', sprintf('liste', $route_name), ['GET']) ?>
<?php if (isset($repository_full_class_name)): ?>
    public function index(<?= $repository_class_name ?> $<?= $repository_var ?>): Response
    {
        return $this->render('<?= $templates_path ?>/index.html.twig', [
            '<?= $entity_twig_var_plural ?>' => $<?= $repository_var ?>->findAll(),
        ]);
    }
<?php else: ?>
    public function index(EntityManagerInterface $entityManager): Response
    {
        $<?= $entity_var_plural ?> = $entityManager
            ->getRepository(<?= $entity_class_name ?>::class)
            ->findAll();

        return $this->render('<?= $templates_path ?>/index.html.twig', [
            '<?= $entity_twig_var_plural ?>' => $<?= $entity_var_plural ?>,
        ]);
    }
<?php endif ?>

<?= $generator->generateRouteForControllerMethod('/nouveau', sprintf('nouveau', $route_name), ['GET', 'POST']) ?>
<?php if (isset($repository_full_class_name) && $generator->repositoryHasAddRemoveMethods($repository_full_class_name)) { ?>
    public function new(Request $request, <?= $repository_class_name ?> $<?= $repository_var ?>): Response
<?php } else { ?>
    public function new(Request $request, EntityManagerInterface $entityManager): Response
<?php } ?>
    {
        $<?= $entity_var_singular ?> = new <?= $entity_class_name ?>();
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);

<?php if (isset($repository_full_class_name) && $generator->repositoryHasAddRemoveMethods($repository_full_class_name)) { ?>
        if ($form->isSubmitted() && $form->isValid()) {
            $<?= $repository_var ?>->add($<?= $entity_var_singular ?>, true);

            return $this->redirectToRoute('<?= str_replace("app_","",$route_name) ?>_liste', [], Response::HTTP_SEE_OTHER);
        }
<?php } else { ?>
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($<?= $entity_var_singular ?>);
            $entityManager->flush();

            return $this->redirectToRoute('<?= str_replace("app_","",$route_name) ?>_liste', [], Response::HTTP_SEE_OTHER);
        }
<?php } ?>

<?php if ($use_render_form) { ?>
        return $this->renderForm('<?= $templates_path ?>/new.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form,
        ]);
<?php } else { ?>
        return $this->render('<?= $templates_path ?>/new.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form->createView(),
        ]);
<?php } ?>
    }

<?= $generator->generateRouteForControllerMethod(sprintf('/visualiser/{%s}', $entity_identifier), sprintf('visualiser', $route_name), ['GET']) ?>
    public function show(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        return $this->render('<?= $templates_path ?>/show.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
        ]);
    }

<?= $generator->generateRouteForControllerMethod(sprintf('/modifier/{%s}', $entity_identifier), sprintf('modifier', $route_name), ['GET', 'POST']) ?>
<?php if (isset($repository_full_class_name) && $generator->repositoryHasAddRemoveMethods($repository_full_class_name)) { ?>
    public function edit(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>, <?= $repository_class_name ?> $<?= $repository_var ?>): Response
<?php } else { ?>
    public function edit(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>, EntityManagerInterface $entityManager): Response
<?php } ?>
    {
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);

<?php if (isset($repository_full_class_name) && $generator->repositoryHasAddRemoveMethods($repository_full_class_name)) { ?>
        if ($form->isSubmitted() && $form->isValid()) {
            $<?= $repository_var ?>->add($<?= $entity_var_singular ?>, true);

            return $this->redirectToRoute('<?= str_replace("app_","",$route_name) ?>_liste', [], Response::HTTP_SEE_OTHER);
        }
<?php } else { ?>
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('<?= str_replace("app_","",$route_name) ?>_liste', [], Response::HTTP_SEE_OTHER);
        }
<?php } ?>

<?php if ($use_render_form) { ?>
        return $this->renderForm('<?= $templates_path ?>/edit.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form,
        ]);
<?php } else { ?>
        return $this->render('<?= $templates_path ?>/edit.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form->createView(),
        ]);
<?php } ?>
    }

<?= $generator->generateRouteForControllerMethod(sprintf('/supprimer/{%s}', $entity_identifier), sprintf('supprimer', $route_name), ['POST']) ?>
<?php if (isset($repository_full_class_name) && $generator->repositoryHasAddRemoveMethods($repository_full_class_name)) { ?>
    public function delete(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>, <?= $repository_class_name ?> $<?= $repository_var ?>): Response
<?php } else { ?>
    public function delete(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>, EntityManagerInterface $entityManager): Response
<?php } ?>
    {
<?php if (isset($repository_full_class_name) && $generator->repositoryHasAddRemoveMethods($repository_full_class_name)) { ?>
        if ($this->isCsrfTokenValid('delete'.$<?= $entity_var_singular ?>->get<?= ucfirst($entity_identifier) ?>(), $request->request->get('_token'))) {
            $<?= $repository_var ?>->remove($<?= $entity_var_singular ?>, true);
        }
<?php } else { ?>
        if ($this->isCsrfTokenValid('delete'.$<?= $entity_var_singular ?>->get<?= ucfirst($entity_identifier) ?>(), $request->request->get('_token'))) {
            $entityManager->remove($<?= $entity_var_singular ?>);
            $entityManager->flush();
        }
<?php } ?>

        return $this->redirectToRoute('<?= str_replace("app_","",$route_name) ?>_liste', [], Response::HTTP_SEE_OTHER);
    }
}
