{% extends 'base.html.twig' %}

{% block title %}{{ 'entity.<?= $route_name ?>.show'|trans }} {{ <?= $entity_twig_var_singular ?> }}{% endblock %}

{% block menu %}
    {% embed 'Menu/menu.html.twig' %}

        {% set menuEntity = '<?= $route_name ?>' %}
        {% set menuAction = 'show' %}
        {% set entity = <?= $entity_twig_var_singular ?>  %}

    {% endembed %}
{% endblock menu %}

{% block body %}

<div class="row">

    <div class="small-12 columns small-centered">
        <div class="callout">
            <table class='text-left'>
                <tbody>
                <?php foreach ($entity_fields as $field): ?>
                    <tr>
                        <th>{{ "entity.<?= $route_name ?>.<?= $field['fieldName'] ?>"|trans }}</th>
                        <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>


{% endblock %}
