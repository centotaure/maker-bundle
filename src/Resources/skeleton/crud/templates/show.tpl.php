<?= $helper->getHeadPrintCode($entity_class_name) ?>

{% block body %}

<div class="row">
    <div class="small-8 columns small-offset-2">
        <div class="callout">
            <table>
                <tbody>
                <?php foreach ($entity_fields as $field): ?>
                    <tr>
                        <th><?= ucfirst($field['fieldName']) ?></th>
                        <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <div class="small-6 columns text-center">
            {{ include('<?= $entity_class_name ?>/delete_form.html.twig') }}
        </div>
        <div class="small-6 columns text-center">
            <a class="button warning "
               href="{{ path('app_<?= $route_name ?>_edit', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}">
                {{'form.<?= $route_name ?>.update'|trans }}</a>
        </div>

    </div>
</div>
<div class="row">
    <div class="small-8 columns small-offset-2">
        <a href="{{ path('app_<?= $route_name ?>_index') }}"> <  {{'entity.<?= $route_name ?>.returnlist'|trans }}</a>
    </div>

</div>


{% endblock %}
