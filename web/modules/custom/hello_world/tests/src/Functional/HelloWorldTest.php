<?php

namespace Drupal\Tests\hello_world\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests for the Lorem Ipsum module.
 *
 * @group loremipsum
 */
class HelloWorldTest extends BrowserTestBase
{
  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'olivero';

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['block', 'block_example', 'hello_world'];

  /**
   * The installation profile to use with this test.
   *
   * This test class requires the "Tools" block.
   *
   * @var string
   */
  protected $profile = 'minimal';

  /**
   * Test for a link to the block example in the Tools menu.
   */
  public function testBlockExampleLink()
  {
    // $this->drupalGet('');
    // $this->assertSession()->linkByHrefExists('examples/block-example');

    $this->drupalGet('/hello');
    $this->assertSession()->statusCodeEquals(200);

    $this->assertSession()->pageTextContains('Our first route');

    // Check if an image exists on the page.
    $this->assertSession()->elementExists('css', 'img');


    $this->assertSession()->responseMatches('/Test image/i');

    $this->assertSession()->elementAttributeContains('css', '#block-olivero-content img', 'alt', 'Test image');


    // Assert that the image has a specific source URL.
    $this->assertSession()->elementAttributeContains('css', 'img', 'src', 'files/test.jpeg');
    $this->assertSession()->responseMatches('/\/files\/test\.jpeg/i');
    // $this->drupalGet('/hello');
    // $this->assertSession()->statusCodeEquals(200);

    // Verify that the block admin page link works.
    // $this->clickLink('the block admin page');
    // Since it links to the admin page, we should get a permissions error and
    // not 404.
    // $this->assertSession()->statusCodeEquals(403);
  }


}
