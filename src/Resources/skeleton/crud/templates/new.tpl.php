{% extends 'base.html.twig' %}

{% block title %}{{ 'entity.<?= strtolower($entity_class_name) ?>.new'|trans }}{% endblock %}

{% block menu %}
    {% embed 'Menu/menu.html.twig' %}

        {% set menuEntity = '<?= strtolower($entity_class_name) ?>' %}
        {% set menuAction = 'new' %}

    {% endembed %}
{% endblock menu %}

{% block body %}

    {% include 'Form/new.html.twig' %}

{% endblock %}
