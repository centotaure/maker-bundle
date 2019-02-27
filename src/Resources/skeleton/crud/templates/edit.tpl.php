<?= $helper->getHeadPrintCode('Edit ' . $entity_class_name) ?>

{% block body %}

    {% include 'Form/edit.html.twig' with { 'entity':  '<?= $entity_class_name ?>'|lower }  %}

{% endblock %}
