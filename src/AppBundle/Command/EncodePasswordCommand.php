<?php

namespace AppBundle\Command;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EncodePasswordCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:encode-password')
            ->addArgument('password');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $passToEncode = $input->getArgument('password');
        $user = new User('dummy');
        $encoder = $this->getContainer()->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $passToEncode);

        $output->writeln(sprintf('<info>%s</info>', $encoded));
    }

}