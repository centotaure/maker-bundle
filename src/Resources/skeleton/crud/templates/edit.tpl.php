{% extends 'base.html.twig' %}

{% block title %}{{ 'entity.<?= strtolower($entity_class_name) ?>.edit'|trans }}{% endblock %}

{% block menu %}
    {% embed 'Menu/menu.html.twig' %}

        {% set menuEntity = '<?= strtolower($entity_class_name) ?>' %}
        {% set menuAction = 'edit' %}
        {% set entity = <?= $entity_twig_var_singular ?> %}

    {% endembed %}
{% endblock menu %}

{% block body %}

    {% include 'Form/edit.html.twig'  %}

{% endblock %}

