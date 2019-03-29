{% extends 'base.html.twig' %}

{% block title %}{{ ('entity.<?= strtolower($entity_class_name) ?>.delete')|trans }}{% endblock %}

    {% block menu %}
        {% embed 'Menu/menu.html.twig' %}

            {% set menuEntity = '<?= strtolower($entity_class_name) ?>' %}
            {% set menuAction = 'delete' %}
            {% set entity = <?= $entity_var_singular ?> %}


        {% endembed %}
    {% endblock menu %}

{% block body %}

<div class="row">

    <div class="small-12 columns text-center callout">
        <h3>
            {{ 'entity.<?= strtolower($entity_class_name) ?>.deleteconfirm'|trans }} {{ <?= $entity_var_singular ?> }} ?
        </h3>
        {{ form(deleteForm) }}
    </div>
</div>


{% endblock %}
