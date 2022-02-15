# rptags
A silly extension for Mediawiki to add a few useful tags for taking notes for a roleplaying game.  Essentially I use a few mediawiki's to take notes for various roleplaying games, but I wanted to add a couple of useful  tags to the markup for various bits of formatting, hence writing this.

This extension gives you three new tags, ```<ooc></ooc>```, ```<fail />```, and ```<pass />```.


## Number 1: an OOC mechanical note

These are for writing little out of character asides about technical effects of things so sometimes I'll be writing up notes about the narrative of the game and want to include an aside about some sort of game mechnical effect
that is relevant to the understanding of the notes, but irrelevant to the narrative flow I'm writing up, examples include:

```
Alice reads the spooky book <ooc>Alice gets access to the fireball spell, roll Wits + Occult difficulty 6 to passful throw, +2 damage<ooc> and then gives it to Bob to put in a bag.
```

Which produces something like this, where the ooc text a little faded into the background:

```
Alice reads the spooky book (ooc: Alice gets access to the fireball spell, roll Wits + Occult difficulty 6 to passful throw, +2 damage) and then gives it to Bob to put in a bag.
```

## Number 2: A pass or success:

Sometimes I want to make a note that sometime tried something and it worked or didn't while mostly writing the narrative of the game so something like:

```
Alice tries to summon a portal to The Other Realm <pass amount="5" /> which she thinks will last a good while.
```

Which produces something like this, where the [P:5] is in green:

```
Alice tries to summon a portal to The Other Realm [P:5] which she thinks will last a good while.
```

## Number 3: A failure

Or just include the note of a pass/failure to make it faster to write up the notes about something not working, something like:

```
Alice tries to pick the lock <fail />, Bob kicks the door in.
```

Which produces something like this, where the [F] is in red:

```
Alice tries to pick the lock [F], Bob kicks the door in.
```

## Number 4: A pass with a general descriptor

Being as the amount of a quantifier is just a string you can write anything
that makes sense here if passes, or a percentage, or a scale of 1-10 don't
work for you.

```
Alice does a barrel roll in the biplane <pass amount="really-cool" />.
```

Which produces something like this, where the [P:really-cool] is in green.

```
Alice does a barrel roll in the biplane [P:really-cool].
```

# What HTML do I get from my markup?

```<ooc>this is an out of character aside</ooc>```
becomes
```(<span class="ooc">ooc: this is out of character aside</span>)```

```<fail />```
becomes
```<span class="failroll">[F]</span>```

```<fail amount="3" />```
becomes
```<span class="failroll">[F:3]</span>```

```<pass />```
becomes
```<span class="passroll">[P]</span>```

```<pass amount="5" />```
becomes
```<span class="passroll">[P:5]</span>```

# How do I use it?

Drop the directory into your mediawiki's ```extensions``` directory as ```rptags```

Then edit your ```LocalSettings.php``` and add:

```
wfLoadExtension( 'rptags' );
```

# Changing the default formatting:

By default it loads ```resources/ext.rptags/rptags.css``` which assumes a
light coloured theme and fades the OOC notes a little, makes passes green and
fails red.

To override this edit with your [mediawiki's CSS](https://www.mediawiki.org/wiki/Manual:CSS) which normally involves editing these sorts of pages:
```
  example.com/index.php/MediaWiki:Common.css
  example.com/index.php/MediaWiki:Mobile.css
```

Then override the selectors you want to change, such as:

```
span.ooc { 
  // use a different background colour for OOC notes
  background-color: #b4cad1;
  color: Black;
  padding: 2px 4px 2px 4px;
}
```

See the original rptags.css for what needs overloading but broadly its these three spans:

```
span.ooc
span.failroll
span.passroll
```

# See also

Inspired by https://www.mediawiki.org/wiki/Manual:Tag_extensions

Read https://www.mediawiki.org/wiki/Manual:$wgResourceModules for how
things are loaded in the extension.json file and why they are named as they
are.

