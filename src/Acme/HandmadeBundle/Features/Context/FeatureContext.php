<?php

namespace Acme\HandmadeBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendiNngException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\Behat\Context\Step;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Feature context.
 */
class FeatureContext extends MinkContext implements KernelAwareInterface
//class FeatureContext extends BehatContext implements KernelAwareInterface
{
    private $kernel;
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

//
// Place your definition and hook methods here:
//
    /**
     * @Given /^I have done something with "([^"]*)"$/
     */
    public function iHaveDoneSomethingWith($argument)
    {
        $container = $this->kernel->getContainer();
        $container->get('some_service')->doSomethingWith($argument);
    }

    /**
     * @Then /^I should sleep "([^"]*)"$/
     */
    public function iShouldSleep($time)
    {
        $this->getSession()->wait($time, true);
    }

    /**
     * @Given /^I logged in as "([^"]*)" with "([^"]*)" password$/
     */
    public function iLoggedInWithPassword($username, $password)
    {
        return array(
            new Step\Given("I am on \"/login\""),
            new Step\When("I fill in \"Username\" with \"admin\""),
            new Step\When("I fill in \"Password\" with \"111111\""),
            new Step\When("I press \"_submit\""),
            new Step\Then("I should be on \"/\""),
        );
    }
}