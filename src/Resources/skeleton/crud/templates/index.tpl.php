<?= $helper->getHeadPrintCode($entity_class_name.' index'); ?>

{% block body %}
    {% include 'Grid/index.html.twig' with {'entity': '<?= $route_name ?>' } %}
{% endblock %}
