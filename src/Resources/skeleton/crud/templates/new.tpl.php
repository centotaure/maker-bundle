<?= $helper->getHeadPrintCode('New '.$entity_class_name) ?>

{% block body %}

    {% include 'Form/new.html.twig' with {'entity': '<?= $entity_class_name ?>'} %}

{% endblock %}
