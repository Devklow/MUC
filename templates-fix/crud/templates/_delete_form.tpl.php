<form method="post" action="{{ path('<?= substr($route_name,4) ?>_supprimer', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}"
      class="d-inline form-modal" data-modal-title="Suppression"
      data-modal-body="Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible." id="form_delete_<?= $entity_identifier ?>">
    <input type="hidden" name="_token" value="{{ csrf_token('delete' ~ <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>) }}">

    {% if liste is defined %}
        <button class="btn btn-link p-0 pb-1"><i class="fa fa-trash-can text-danger" data-toggle="tooltip" title='Supprimer'></i></button>
    {% else %}
        <button class="btn btn-outline-danger mr-2">Supprimer</button>
    {% endif %}
</form>
