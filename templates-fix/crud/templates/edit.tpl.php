<?= $helper->getHeadPrintCode('Edit '.$entity_class_name) ?>
{% block body %}
<div class="card elevation-2">
    <div class="card-header">
        <h6 class="card-title">Modification d'un(e) <?= $entity_class_name ?></h6>
    </div>
    {{ form_start(form) }}
    {{ include('<?= $templates_path ?>/_form.html.twig') }}
    <div class="card-footer text-center">
        <a class="btn btn-outline-secondary" href="{{ path('<?= substr($route_name,4) ?>_liste') }}">Retour</a>
        <button class="btn btn-outline-primary">{{ button_label|default('Enregistrer') }}</button>
    </div>
    {{ form_end(form) }}
</div>

{% endblock %}
