<?php

/* 

Inspired by https://www.mediawiki.org/wiki/Manual:Tag_extensions

read https://www.mediawiki.org/wiki/Manual:$wgResourceModules for how
things are loaded in the extension.json file and why they are named as they
are.

To load this add the following to LocalSettings.php:
  wfLoadExtension( 'rptags' );

overwrite the example given css by changing:
example.com/index.php/MediaWiki:Common.css
example.com/index.php/MediaWiki:Mobile.css

.ooc { 
  // background-color: #b4cad1;
  // color: Black;
  color: DarkGray;
  padding: 2px 4px 2px 4px;
}

.failroll {
  color: red;
}

.passroll {
  color: green;
}

*/

use OutputPage;

class rptags {
	// Load the CSS
	public static function loadstyles( OutputPage &$out ) {
	  $out->addModuleStyles('ext.rptags');
	  return true;
	}

	// Add the hooks for the parser remember these only trigger on a fresh
	// reparse, like an edit.
	public static function init( Parser $parser ) {
	  $parser->setHook( 'ooc', [ self::class, 'renderTagOOC' ] );
	  $parser->setHook( 'fail', [ self::class, 'renderTagFail' ] );
	  $parser->setHook( 'pass', [ self::class, 'renderTagpass' ] );
	}

	// Render <ooc>this is ooc</ooc>
	// (<span class="ooc">ooc: this is ooc</span>)
	public static function renderTagOOC( $input, array $args, Parser $parser, PPFrame $frame ) {
	  $output = '(' . '<span class="ooc">ooc: ' . htmlspecialchars($input) . '</span>)';
	  return $output;
	}

	// Render <fail />
	// <span class="failroll">[F]</span>
	//
	// Render <fail amount="3" />
	// <span class="failroll">[F:3]</span>
	public static function renderTagFail( $input, array $args, Parser $parser, PPFrame $frame ) {
	  if (isset($args["amount"])) {
	    $output = '<span class="failroll">' . htmlspecialchars('[F:' . $args["amount"] . ']') . '</span>';
	  }
	  else {
	    $output = '<span class="failroll">' . htmlspecialchars("[F]") . '</span>';
	  }
	  return $output;
	}

	// Render <pass />
	// <span class="passroll">[P]</span>
	//
	// Render <pass amount="5" />
	// <span class="passroll">[P:5]</span>
	public static function renderTagpass( $input, array $args, Parser $parser, PPFrame $frame ) {
	  if (isset($args["amount"])) {
	    $output = '<span class="passroll">' . htmlspecialchars('[P:' . $args["amount"] . ']') . '</span>';
	  }
	  else {
	    $output = '<span class="passroll">' . htmlspecialchars("[P]") . '</span>';
	  }
	  return $output;
	}
}


