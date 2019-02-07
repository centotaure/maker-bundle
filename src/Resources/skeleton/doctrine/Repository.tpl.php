<?= "<?php\n"; ?>

namespace <?= $namespace; ?>;

use <?= $entity_full_class_name; ?>;
use Doctrine\ORM\EntityRepository;


class <?= $class_name; ?> extends EntityRepository
{
    public function getList($source, $securityChecker, $user)
    {

    }
}
