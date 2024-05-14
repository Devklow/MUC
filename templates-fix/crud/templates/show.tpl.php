<?= $helper->getHeadPrintCode($entity_class_name) ?>

{% block body %}
<div class="card elevation-2">
    <div class="card-header">
        <h6 class="card-title">Visualisation d'un(e) <?= $entity_class_name ?></h6>
    </div>
    <div class="card-body">
        <dl class="row">
            <?php foreach ($entity_fields as $field): ?>
                <dt class="col-sm-6 text-right"><?= ucfirst($field['fieldName']) ?> :</dt>
                <dd class="col-sm-6 text-secondary">{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</dd>
            <?php endforeach; ?>
        </dl>
    </div>
    <div class="card-footer text-center d-flex justify-content-center">
        <a class="btn btn-outline-secondary mr-2" href="{{ path('<?= substr($route_name,4) ?>_liste') }}">Retour</a>
        <a class="btn btn-outline-warning mr-2" href="{{ path('<?= substr($route_name,4) ?>_modifier', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}">Modifier</a>
        {{ include('<?= $templates_path ?>/_delete_form.html.twig') }}
    </div>

{% endblock %}
