<?= $helper->getHeadPrintCode('Edit ' . $entity_class_name) ?>

{% block body %}

    {% include 'Form/edit.html.twig' with { 'className':  '<?= strtolower($entity_class_name) ?>', 'entity' : <?= $entity_twig_var_singular ?>}  %}

{% endblock %}
