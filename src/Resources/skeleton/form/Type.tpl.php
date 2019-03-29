<?= "<?php\n" ?>

namespace <?= $namespace ?>;

<?php if ($bounded_full_class_name): ?>
use <?= $bounded_full_class_name ?>;
<?php endif ?>
use Symfony\Component\Form\AbstractType;
<?php foreach ($field_type_use_statements as $className): ?>
use <?= $className ?>;
<?php endforeach; ?>
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
<?php foreach ($constraint_use_statements as $className): ?>
use <?= $className ?>;

<?php endforeach; ?>

class <?= $class_name ?> extends SecurityFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<?php foreach ($form_fields as $form_field => $typeOptions): ?>
<?php if ($form_field !== "createdAt" && $form_field !== "updatedAt" && $form_field !== "deletedAt"):  ?>
    <?php if (null === $typeOptions['type'] && !$typeOptions['options_code']): ?>
                ->add('<?= $form_field ?>',null,["label" => "entity.<?= strtolower($bounded_class_name)?>.<?= $form_field ?>"])
    <?php elseif (null !== $typeOptions['type'] && !$typeOptions['options_code']): ?>
                ->add('<?= $form_field ?>', <?= $typeOptions['type'] ?>::class,["label"=>"entity.<?= strtolower($bounded_class_name)?>.<?= $form_field ?>"])
    <?php else: ?>
                ->add('<?= $form_field ?>', <?= $typeOptions['type'] ? ($typeOptions['type'].'::class') : 'null' ?>, [
    <?= $typeOptions['options_code']."\n" ?>
                ])
    <?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
                );
    }

    public function onPreSetData(FormEvent $event)
    {
        $this->addSubmitButton($event);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
<?php if ($bounded_full_class_name): ?>
            'data_class' => <?= $bounded_class_name ?>::class,
<?php else: ?>
            // Configure your form options here
<?php endif ?>
        ]);
    }
}
