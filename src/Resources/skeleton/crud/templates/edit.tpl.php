<?= $helper->getHeadPrintCode('Edit ' . $entity_class_name) ?>

{% block body %}

    {% include 'Form/edit.html.twig' with {'title': 'tochange' , 'entity': '<?= $entity_class_name ?>' } %}

{% endblock %}
