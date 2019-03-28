{% extends 'base.html.twig' %}

{% block title %} {{ 'entity.<?= strtolower($entity_class_name) ?>.index'|trans }} {% endblock %}

{% block menu %}
    {% embed 'Menu/menu.html.twig' %}

        {% set menuEntity = '<?= strtolower($entity_class_name) ?>' %}
        {% set menuAction = 'index' %}

    {% endembed %}
{% endblock menu %}

{% block body %}
    {% embed 'Grid/index.html.twig' %}

    {% endembed %}

{% endblock body %}
