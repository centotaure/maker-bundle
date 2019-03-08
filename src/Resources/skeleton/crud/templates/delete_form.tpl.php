<form method="post"
      action="{{ path('app_<?= $route_name ?>_delete', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}"
      onsubmit="return confirm({{ 'form.<?= $route_name ?>.confirm'|trans }});">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token"
           value="{{ csrf_token('delete' ~ <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>) }}">
    <button class="button alert">{{ 'form.<?= $route_name ?>.delete'|trans }}</button>
</form>
