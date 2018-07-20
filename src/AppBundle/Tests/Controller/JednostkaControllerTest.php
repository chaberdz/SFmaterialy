<?php
//namespace AppBundle\Tests\Controller;

namespace Tests\AppBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class JednostkaControllerTest extends WebTestCase
{



    private function generateRandomString($length = 10) {

          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < $length; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          return $randomString;
  }


    public function testIndex() {

        $client = static::createClient();
        $crawler = $client->request('GET', '/jednostka/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Lista jednostek")')->count()
        );

    }


    /**
    * @dataProvider additionProvider
    */

    public function testNewSample($nazwa, $skrot, $expected) {

      $client = static::createClient();
      $crawler = $client->request('GET', '/jednostka/new');

      $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /jednostka/new");

      $form = $crawler->selectButton('Create')->form();

      // set some values
      $form['jednostka[nazwa]'] = $nazwa;
      $form['jednostka[skrot]'] = $skrot;

      // submit the form
      $crawler = $client->submit($form);

      if ($client->getResponse()->isRedirect()  )
            $crawler = $client->followRedirect();

      $this->assertEquals($expected,
            $crawler->filter('html:contains("Back to the list")')->count()
      );

    }


    public function additionProvider()
   {
       return [
           'milimetr'  => ['milimetr', 'mm', 0],
           'losowa nazwa'  => [$this->generateRandomString(10), $this->generateRandomString(5),1]
       ];
   }


}
