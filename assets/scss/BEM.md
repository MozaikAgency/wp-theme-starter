# BEM - (Block, Element, Modifier)
## BEM Simplified

### Block

A _Block_ is a **simple class name** which should generally represent a **module**. 
There should always be **only one** _Block_ per each file; and the filename should be
the same as the _Block_ name (eg: `.slider { ...` is the only _Block_ within the file: `_slider.scss`). 

A _simple class name_ is a class name which is lowercase, where english words 
are separated with `-` and it does not contain `__` or `--`.

#### Block Examples:

	// bad Block class names:
	.Slider { ...
	.heroImage { ...
	.entry__title { ...
	.active { ...
	.visible { ...
	
	// good Block class names:
	.slider { ...
	.hero-image { ...
	.entry { ...
	
### Element

An _Element_ is a **child of a Block**, this relationship is represented by using the
`{Block}__{Element}` pattern. An _Element_ **is not** a child of another _Element_.
An _Element_ name should follow the same rules as a **simple class name**. _Element_ names
should be descriptive of the general idea of what they are styling and not reference
the underlying markup.

#### Element Examples:

	// bad Element class names:
	.slide { ... // this denotes a Block not an Element!
	.slider-slide { ... // this denotes a Block not an Element!
	.slider__SlideTitle { ...
	(Block: .slider) .sr__slide { ... // Block name in Element class name must be exactly the same as Block name
	.slider__slide__title { ...
	.slider__h2 { ... // Element name unnecessarily specific to HTML
	
	// good Element class names:
	.slider__slide { ...
	.slider__slide-title { ...
	.slider__subtitle { ...

### Modifier

A _Modifier_ can be used with either a **Block** or an **Element** using the `{Block}(__{Element})?--{Modifier}`
pattern. A _Modifier_ name should follow the same rules as a **simple class name**.

#### Modifier Examples

	// bad Modifier class names:
	.visible { ...
	.active { ...
	.page--DisableScroll { ...
	
	// good Modifier class names:
	.entry--visible { ...
	.tabs__tab--active { ...
	.page--disable-scroll { ...
