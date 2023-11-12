<?php
/**
 * Class CoreTest
 *
 * @package Prox_Ai_Editor
 */

/**
 * Core test case.
 */
class CoreTest extends WP_UnitTestCase {
    public function test_singleton_instance() {
        $instance1 = Prox_Ai_Editor::instance();
        $instance2 = Prox_Ai_Editor::instance();

        $this->assertInstanceOf( Prox_Ai_Editor::class, $instance1 );
        $this->assertSame( $instance1, $instance2 );
    }

    public function test_constants_setup() {
        $editor = Prox_Ai_Editor::instance();

        $this->assertTrue( defined( 'PROX_AI_EDITOR_VERSION' ) );
        $this->assertTrue( defined( 'PROX_AI_EDITOR_FILE' ) );
        $this->assertTrue( defined( 'PROX_AI_EDITOR_PATH' ) );
        $this->assertTrue( defined( 'PROX_AI_EDITOR_URL' ) );
    }

    public function test_includes() {
        $this->assertTrue(
            file_exists( PROX_AI_EDITOR_PATH . 'functions.php' ) &&
            file_exists( PROX_AI_EDITOR_PATH . 'class-prox-admin.php' )
        );
    }

    public function test_admin_menu_hook() {
        $editor = Prox_Ai_Editor::instance();
        $this->assertEquals(
            10,
            has_action( 'admin_menu', array( $editor, 'prox_ai_settings_page' ) )
        );
    }

    public function test_display_prox_settings() {
        ob_start();
        $editor = Prox_Ai_Editor::instance();
        $editor->display_prox_settings();
        $output = ob_get_clean();

        $this->assertStringContainsString( '<div class="prox-wrap"></div>', $output );
    }

}
