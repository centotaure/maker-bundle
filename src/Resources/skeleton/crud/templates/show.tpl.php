<?= $helper->getHeadPrintCode($entity_class_name) ?>

{% block body %}

<div class="row">
    <div class="small-12 columns text-center">
        <h1>{{ "entity.<?= $route_name ?>.show"|trans }} {{<?= $entity_twig_var_singular ?>.name }}</h3>
    </div>
    <div class="small-12 columns small-centered">
        <div class="callout">
            <table class='text-left'>
                <tbody>
                <?php foreach ($entity_fields as $field): ?>
                    <tr>
                        <th>{{ "entity.<?= $route_name ?>.<?= $field['fieldName'] ?>"|trans }}</th>
                        <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <div class="small-6 columns text-center">
        <a onClick="$('#delete<?= $route_name ?>').children().submit();" title="{{ "form.delete"|trans }}">
        <img src="{{ asset('/images/delete.svg') }}" class="medium-pic">
        </a>
        <div id="delete<?= $route_name ?>" class="hide">
            {{ form(deleteForm) }}
        </div>
    </div>
    <div class="small-6 columns text-center">
        <a href="{{ path('app_<?= $route_name ?>_edit',{'id':<?= $entity_twig_var_singular ?>.id}) }}"
           title="{{ "form.edit"|trans }}">
        <img src="{{ asset('/images/edit.svg') }}" class="medium-pic"/>
        </a>
    </div>


    {% include 'Form/back_route.html.twig' with {'className': '<?= $route_name ?>' , 'entity':  <?= $entity_twig_var_singular ?> ,'destination':'index' } %}

</div>


{% endblock %}
