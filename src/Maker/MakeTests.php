<?php

/*
 * This file is part of the Symfony MakerBundle package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\MakerBundle\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

/**
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Ryan Weaver <weaverryan@gmail.com>
 */
final class MakeTests extends AbstractMaker
{
    public static function getCommandName(): string
    {
        return 'make:tests';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConf)
    {
        $command
            ->setDescription('Creates a new unit test class and functional test')
            ->addArgument('name', InputArgument::OPTIONAL, 'The name of the unit test class (e.g. <fg=yellow>UtilTest</>)')
            ->setHelp(file_get_contents(__DIR__ . '/../Resources/help/MakeUnitTest.txt'));
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {

        $command = $this->getApplication()->find('make:unit-test');

        $arguments = [
            'command' => 'make:unit-test',
            'name'    => $input->getArgument('name')
        ];

        $greetInput = new ArrayInput($arguments);
        $returnCode = $command->run($greetInput, $output);

        $command = $this->getApplication()->find('make:functional-test');

        $arguments = [
            'command' => 'make:functional-test',
            'name'    => $input->getArgument('name')
        ];

        $greetInput = new ArrayInput($arguments);
        $returnCode = $command->run($greetInput, $output);
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
    }
}
