<?= $helper->getHeadPrintCode($entity_class_name.' index'); ?>

{% block body %}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6 text-left"><h6 class="mt-2 font-weight-bold text-primary">Liste des <?= $entity_class_name ?></h6></div>
            <div class="col-md-6 text-right">
                <a class="btn btn-sm btn-outline-primary" href="{{ path('<?= substr($route_name,4) ?>_nouveau') }}">Créer un(e) <?= $entity_class_name ?></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table datatable table-bordered">
            <thead>
                <tr>
    <?php foreach ($entity_fields as $field): ?>
                    <th class="text-center"><?= ucfirst($field['fieldName']) ?></th>
    <?php endforeach; ?>
                    <th class="text-center" data-orderable="false">Actions</th>
                </tr>
            </thead>
            <tbody>
            {% for <?= $entity_twig_var_singular ?> in <?= $entity_twig_var_plural ?> %}
                <tr>
    <?php foreach ($entity_fields as $field): ?>
                    <td class="text-center">{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
    <?php endforeach; ?>
                    <td class="text-center">
                        <a href="{{ path('<?= substr($route_name,4) ?>_visualiser', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}"><i class="fa fa-search text-primary" data-toggle="tooltip" title="Voir"></i></a>
                        <a href="{{ path('<?= substr($route_name,4) ?>_modifier', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}"><i class="fa fa-edit text-warning ml-2 mr-2" data-toggle="tooltip" title='Modifier'></i></a>
                        {{ include('<?= str_replace("templates/","",str_replace("index.html.twig","_delete_form.html.twig",$relative_path)) ?>', {liste:true}) }}
                    </td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    </div>
</div>
<div class="col-sm-12 text-center">
    <a class="btn btn-outline-primary" href="{{ path('<?= substr($route_name,4) ?>_nouveau') }}">Créer un(e) <?= $entity_class_name ?></a>
</div>
{{ include('fragments/main-confirm-modal.html.twig', {liste:true}) }}
{% endblock %}

{% block javascripts %}
{{ include('fragments/data-tables.html.twig') }}
{% endblock %}