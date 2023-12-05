<?php
/**
 * Plugin Name:     Lightning Customize Plugin（名前は適当に変更してください）
 * Plugin URI:      https://github.com/vektor-inc/lightning-customize-plugin
 * Description:
 * Author:
 * Author URI:
 * Text Domain:     lightning-customize-plugin
 * Domain Path:     /languages
 * Version:         0.3.0
 * License:         GNU General Public License v2 or later
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package         lightning-customize-plugin
 */

/************************************************
 * 独自CSSファイルの読み込み処理
 *
 * 選択中のスキンに加えてCSSを読み込む場合の処理です。
 */

// 独自のCSSファイル（assets/css/）を読み込む場合は true に変更してください.
$my_lightning_custom_css = false;

if ( $my_lightning_custom_css ) {
	// 公開画面側のCSSの読み込み.
	add_action(
		'wp_enqueue_scripts',
		function () {
			wp_enqueue_style(
				'my-lightning-custom',
				plugin_dir_url( __FILE__ ) . '/assets/css/style.css',
				array( 'lightning-design-style' ),
				filemtime( dirname( __FILE__ ) . '/assets/css/style.css' )
			);
		}
	);
	// 編集画面側のCSSの読み込み.
	add_action(
		'enqueue_block_editor_assets',
		function () {
			wp_enqueue_style(
				'my-lightning-custom-editor',
				plugin_dir_url( __FILE__ ) . '/assets/css/editor.css',
				array( 'wp-edit-blocks', 'lightning-gutenberg-editor' ),
				filemtime( dirname( __FILE__ ) . '/assets/css/editor.css' )
			);
		}
	);
}

function my_ltg_add_entry_content( $content ) {
	// 表示を改変する投稿タイプの条件分岐.
	if ( 'post' === get_post_type() ) {
		// 本文の内容の最後に要素を追加.
		$content .= '<div>プラグインからカスタムフィールドなどの情報</div>';
	}
	// 本文の内容を返す.
	return $content;
}
add_filter( 'the_content', 'my_ltg_add_entry_content', 8 );
/************************************************
 * 独自の処理を必要に応じて書き足します
 */
