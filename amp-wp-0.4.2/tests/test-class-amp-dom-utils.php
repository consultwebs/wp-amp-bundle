<?php

class AMP_DOM_Utils_Test extends WP_UnitTestCase {
	public function test_utf8_content() {
		$source = '<p>Iñtërnâtiônàlizætiøn</p>';
		$expected = '<p>Iñtërnâtiônàlizætiøn</p>';

		$dom = AMP_DOM_Utils::get_dom_from_content( $source );
		$content = AMP_DOM_Utils::get_content_from_dom( $dom );
		$this->assertEquals( $expected, $content );
	}

	public function test_add_attributes_to_node__no_attributes() {
		$dom = AMP_DOM_Utils::get_dom_from_content( '<p>Hello World</p>' );
		$node = $dom->createElement( 'b' );
		AMP_DOM_Utils::add_attributes_to_node( $node, array() );
		$this->assertFalse( $node->hasAttributes() );
	}

	public function test_add_attributes_to_node__attribute_without_value() {
		$dom = AMP_DOM_Utils::get_dom_from_content( '<p>Hello World</p>' );
		$node = $dom->createElement( 'div' );
		$attributes = array( 'placeholder' => '' );
		AMP_DOM_Utils::add_attributes_to_node( $node, $attributes );

		$this->assertTrue( $node->hasAttributes() );
		$this->check_node_has_attributes( $node, $attributes );
	}

	public function test_add_attributes_to_node__attribute_with_value() {
		$dom = AMP_DOM_Utils::get_dom_from_content( '<p>Hello World</p>' );
		$node = $dom->createElement( 'div' );
		$attributes = array( 'class' => 'myClass', 'id' => 'myId' );
		AMP_DOM_Utils::add_attributes_to_node( $node, $attributes );

		$this->assertTrue( $node->hasAttributes() );
		$this->check_node_has_attributes( $node, $attributes );
	}

	protected function check_node_has_attributes( $node, $attributes ) {
		$this->assertEquals( count( $attributes ), $node->attributes->length );
		foreach ( $node->attributes as $attr ) {
			$name = $attr->nodeName;
			$value = $attr->nodeValue;

			$this->assertTrue( array_key_exists( $name, $attributes ), sprintf( 'Attribute "%s" not found.', $name ) );
			$this->assertEquals( $attributes[ $name ], $value, sprintf( 'Attribute "%s" does not have expected value.', $name ) );
		}
	}

	public function test__is_node_empty__yes() {
		$source = '<p></p>';
		$dom = AMP_DOM_Utils::get_dom_from_content( $source );
		$node = $dom->getElementsByTagName( 'p' )->item( 0 );

		$this->assertTrue( AMP_DOM_Utils::is_node_empty( $node ) );
	}

	public function test__is_node_empty__no__has_text() {
		$source = '<p>Hello</p>';
		$dom = AMP_DOM_Utils::get_dom_from_content( $source );
		$node = $dom->getElementsByTagName( 'p' )->item( 0 );

		$this->assertFalse( AMP_DOM_Utils::is_node_empty( $node ) );
	}

	public function test__is_node_empty__no__has_child() {
		$source = '<p><b></b></p>';
		$dom = AMP_DOM_Utils::get_dom_from_content( $source );
		$node = $dom->getElementsByTagName( 'p' )->item( 0 );

		$this->assertFalse( AMP_DOM_Utils::is_node_empty( $node ) );
	}

	public function test__get_content_from_dom__br_no_closing_tag() {
		$source = '<br/>';
		$expected = '<br/>';

		$dom = AMP_DOM_Utils::get_dom_from_content( $source );
		$actual = AMP_DOM_Utils::get_content_from_dom( $dom );

		$this->assertEquals( $expected, $actual );
	}

	public function test__recursive_force_closing_tags__ignore_non_elements() {
		$dom = new DOMDocument;
		$node = $dom->createAttribute( 'src' );
		$expected = ' src=""';

		$actual = AMP_DOM_Utils::recursive_force_closing_tags( $dom, $node );

		$this->assertEquals( $expected, $dom->saveXML( $node ) );
	}

	public function test__recursive_force_closing_tags__ignore_self_closing() {
		$dom = new DOMDocument;
		$node = $dom->createElement( 'br' );
		$expected = '<br/>';

		$actual = AMP_DOM_Utils::recursive_force_closing_tags( $dom, $node );

		$this->assertEquals( $expected, $dom->saveXML( $node ) );
	}

	public function test__recursive_force_closing_tags__ignore_non_empty() {
		$dom = new DOMDocument;
		$node = $dom->createElement( 'p' );
		$text = $dom->createTextNode( 'Hello' );
		$node->appendChild( $text );
		$expected = '<p>Hello</p>';

		$actual = AMP_DOM_Utils::recursive_force_closing_tags( $dom, $node );

		$this->assertEquals( $expected, $dom->saveXML( $node ) );
	}

	public function test__recursive_force_closing_tags__force_close() {
		$dom = new DOMDocument;
		$node = $dom->createElement( 'amp-img' );
		$expected = '<amp-img></amp-img>';

		AMP_DOM_Utils::recursive_force_closing_tags( $dom, $node );

		$this->assertEquals( $expected, $dom->saveXML( $node ) );
		// Extra test to confirm we added the child node
		$this->assertTrue( $node->hasChildNodes() );
		$this->assertEquals( '', $node->firstChild->nodeValue );
	}

	public function test__recursive_force_closing_tags__force_close_with_children() {
		$dom = new DOMDocument;
		$node = $dom->createElement( 'div' );
		$child_with_closing = $dom->createElement( 'amp-img' );
		$child_self_closing = $dom->createElement( 'br' );
		$node->appendChild( $child_with_closing );
		$node->appendChild( $child_self_closing );
		$expected = '<div><amp-img></amp-img><br/></div>';

		AMP_DOM_Utils::recursive_force_closing_tags( $dom, $node );

		$this->assertEquals( $expected, $dom->saveXML( $node ) );
	}
}
