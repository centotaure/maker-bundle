<?= $helper->getHeadPrintCode($entity_class_name.' index'); ?>

{% block body %}
    {% include 'Grid/index.html.twig' with {'className': '<?= strtolower($entity_class_name) ?>' } %}
{% endblock %}
