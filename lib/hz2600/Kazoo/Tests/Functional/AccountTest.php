<?php

namespace Kazoo\Tests\Functional;

use \Kazoo\Tests\Common\FunctionalTest;
use \stdClass;

/**
 * @group functional
 */
class AccountTest extends FunctionalTest
{
    /**
     * @test
     */
    public function testGetMyAccount() {
        $account = $this->getSDK()->Account();

        $this->assertInstanceOf("\\Kazoo\\Api\\Entity\\Account", $account);
        $this->assertTrue((strlen($account->getId()) > 0));
    }

    /**
     * @test
     */
    public function testUpdateMyAccount() {
        $account = $this->getSDK()->Account();
        $account_id = $account->getId();
        $current_json = $account->toJson();

        $this->assertInstanceOf("\\Kazoo\\Api\\Entity\\Account", $account);
        $this->assertTrue((strlen($account_id) > 0));

        // Ensure our test actually updates the name...
        $new_name = "SDK Test " . rand(100, 1000);
        $this->assertNotEquals($account->name, $new_name);
var_dump($account->thing);
        // Update the account name
        $account->name = $new_name;
        $account->thing = !($account->thing);
        $account->save();
var_dump($account->thing);

        // Make sure we didn't create a new account
        $this->assertTrue($account->getId() == $account_id);

        // Ensure that the only property changed was the account name
        // to the expected value
        $updated_json = $account->toJson();
var_dump($updated_json);
var_dump($current_json);
        $diff = $this->compareJson($updated_json, $current_json);
        var_dump($diff);
        $this->assertEquals(count($diff), 1);
        $this->assertEquals($diff['name'], $new_name);

        // Fetch it from the database again to make sure
        $account->fetch();
        $this->assertEquals($account->name, $new_name);
    }

    /**
     * @test
     */
    public function testCreateChildAccount() {
        $account = $this->getSDK()->Account(null);

        $this->assertInstanceOf("\\Kazoo\\Api\\Entity\\Account", $account);
        $this->assertTrue((strlen($account->getId()) == 0));

        $account->name = "SDK Create Test " . rand(100, 1000);
        $account->save();

        $this->assertTrue((strlen($account->getId()) > 0));

        return $account->getId();
    }

    /**
     * @test
     * @depends testCreateChildAccount
     */
    public function testUpdateChildAccount($account_id) {
        $account = $this->getSDK()->Account($account_id);

        $this->assertTrue((strlen($account->getId()) > 0));
        $this->assertEquals($account->getId(), $account_id);

        $current_name = $account->name;
        $new_name = "SDK Update Test " . rand(100, 1000);

        // Ensure our test actually update the name...
        $this->assertNotEquals($current_name, $new_name);

        $account->name = $new_name;
        $account->save();

        // Make sure we didn't create a new account
        $this->assertEquals($account->getId(), $account_id);

        // The local copy is updated with the result of the
        // API request
        $this->assertEquals($account->name, $new_name);

        // Fetch it from the database again to make sure
        $account->fetch();
        $this->assertEquals($account->name, $new_name);
    }

    /**
     * @test
     * @depends testCreateChildAccount
     */
/*    public function testRemoveChildAccount($account_id) {
        $account = $this->getSDK()->Account($account_id);

        $this->assertTrue((strlen($account->getId()) > 0));
        $this->assertEquals($account->getId(), $account_id);

        $account->remove();

        $this->assertTrue((strlen($account->getId()) == 0));
    } */
}
